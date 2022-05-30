<?php

namespace App\Http\Livewire\Admin\Items;

use App\Http\Livewire\Traits\WithAuthorizationMessage;
use App\Http\Livewire\Traits\WithEditsModels;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Account;
use App\Models\Item;
use Livewire\Component;

class Index extends Component
{
    use WithPerPagePagination, WithSearch, WithSorting, WithAuthorizationMessage, WithEditsModels;

    public string $perPageVariable = "itemsPerPage";
    public string $modelName = Item::class;
    public bool $showEditModal = false;
    public bool $showDeleteConfirmation = false;

    public Item $editing;
    public $deleting = null;
    public array $types = ['Category', 'Inventory', 'NonInventory', 'Service'];

    protected function rules()
    {
        $accountIds = implode(',', Account::pluck('qb_account_id')->toArray());
        return [
            'editing.name'                  => 'required|string|max:255',
            'editing.description'           => 'nullable|string|max:255',
            'editing.type'                  => 'required|in:Inventory,Service,NonInventory,Category',
            'editing.active'                => 'required|boolean',
            'editing.taxable'               => 'required|boolean',
            'editing.sales_tax_included'    => 'required|boolean',
            'editing.unit_price'            => 'required|numeric',
            'editing.income_account_ref'    => 'nullable|in:'.$accountIds,
            'editing.purchase_cost'         => 'nullable|numeric',
            'editing.purchase_tax_included' => 'required|boolean',
            'editing.expense_account_ref'   => 'nullable|in:'.$accountIds,
            'editing.track_qty_on_hand'     => 'required|boolean',
            'editing.qty_on_hand'           => 'nullable|numeric',
            'editing.sync'                  => 'required|boolean'
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankModel();
    }

    public function makeBlankModel()
    {
        return Item::make([
            'active'                => true,
            'taxable'               => true,
            'sales_tax_included'    => false,
            'type'                  => 'NonInventory',
            'purchase_tax_included' => false,
            'track_qty_on_hand'     => false,
            'sync'                  => true,
            'qty_on_hand'           => 0,
            'unit_price'            => 0
        ]);
    }

    public function getRowsQueryProperty()
    {
        $query = Item::query()
                     ->search($this->search);

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }


    public function render()
    {
        return view('livewire.admin.items.index', ['items' => $this->rows]);
    }
}
