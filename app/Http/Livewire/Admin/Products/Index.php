<?php

namespace App\Http\Livewire\Admin\Products;

use App\Http\Livewire\Traits\WithAuthorizationMessage;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Account;
use App\Models\Item;
use App\Models\Product;
use Livewire\Component;

class Index extends Component
{
    use WithPerPagePagination, WithSearch, WithSorting, WithAuthorizationMessage;

    public string $perPageVariable = "itemsPerPage";

    public bool $showEditModal = false;
    public bool $showDeleteModal = false;

    public Product $editing;
    public $deleting = null;
    public $items;


    protected function rules()
    {
        return [
            'editing.item_id' => 'required|exists:items,id',
            'editing.name' => 'required|string|max:255',
            'editing.price' => 'required|numeric',
        ];
    }

    public function create()
    {
        if (auth()->user()->cannot('products.create')) {
            return $this->denied();
        }

        if ($this->editing->getKey()) {
            $this->editing = $this->makeBlankProduct();
        }

        $this->showEditModal = true;
    }

    public function save()
    {
        $isEditing = !!$this->editing->getKey();

        if ($isEditing && auth()->user()->cannot('products.update')) {
            return $this->denied();
        }

        if (!$isEditing && auth()->user()->cannot('products.create')) {
            return $this->denied();
        }

        $this->validate();

        $this->editing->save();

        $this->notify("Product saved successfully.");

        $this->showEditModal = false;
    }

    public function edit($productId)
    {
        $product = Item::findOr($productId, function() {
            $this->notify("Can't find product");
        });

        if (!$product) return;

        if (auth()->user()->cannot('products.update')) {
            return $this->denied();
        }

        if ($this->editing->isNot($product)) {
            $this->editing = $product;
        }

        $this->showEditModal = true;
    }

    public function confirmDelete($productId)
    {
        $product = Item::findOr($productId, function() {
            $this->notify("Can't find product");
        })->first();

        if (!$product) return;

        if ($this->checkIfCanDelete($product)) {
            $this->deleting = $product;
            $this->showDeleteModal = true;
        }
    }

    public function delete()
    {
        if (!$this->deleting) return;

        if (!$this->checkIfCanDelete($this->deleting)) return;

        if ($this->editing->is($this->deleting)) $this->editing = $this->makeBlankProduct();

        $this->deleting->delete();

        $this->showDeleteModal = false;
        $this->notify("Product has been deleted successfully!");
    }

    public function checkIfCanDelete(Product $product)
    {
        if (auth()->user()->cannot('products.destroy')) return $this->denied();

        return true;
    }


    public function mount()
    {
        $this->editing = $this->makeBlankProduct();
        $this->items = Item::all();
    }

    public function makeBlankProduct()
    {
        return Product::make();
    }

    public function getRowsQueryProperty()
    {
        $query = Product::query()
                     ->search($this->search);

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }


    public function render()
    {
        return view('livewire.admin.products.index', ['products' => $this->rows]);
    }
}
