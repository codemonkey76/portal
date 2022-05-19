<?php

namespace App\Http\Livewire\Admin\ServiceAgreements\Products;

use App\Models\Product;
use App\Models\ProductServiceAgreement;
use App\Models\ServiceAgreement;
use Livewire\Component;

class Create extends Component
{
    protected $listeners = ['showAddProduct' => 'show'];
    public ServiceAgreement $agreement;
    public $showModal = false;
    public $products;
    public $product_selected;

    public ProductServiceAgreement $product;


    public function rules()
    {
        return [
            'product.name' => 'required|string|max:255',
            'product.qty' => 'required|numeric|min:1',
            'product.unit_price' => 'required|numeric',
            'product.product_id' => 'required|exists:products,id',
            'product.service_agreement_id' => 'required|exists:service_agreements,id'
        ];
    }

    public function updatedProductProductId()
    {
        $selected = Product::find($this->product->product_id);
        $this->product->name = $selected->name;
        $this->product->unit_price = $selected->price;
    }

    public function show()
    {
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->product->save();
        $this->product = $this->makeBlankProductServiceAgreement();
        $this->showModal = false;
        $this->emitUp('refreshServiceAgreement');
    }
    public function makeBlankProductServiceAgreement()
    {
        return ProductServiceAgreement::make([
            'qty' => 1,
            'service_agreement_id' => $this->agreement->id
        ]);
    }
    public function mount()
    {
        $this->products = Product::all();
        $this->product = $this->makeBlankProductServiceAgreement();
    }

    public function render()
    {
        return view('livewire.admin.service-agreements.products.create');
    }
}
