<?php

namespace App\Http\Livewire\Admin\ServiceAgreements\Products;

use App\Models\ProductServiceAgreement;
use App\Models\ServiceAgreement;
use Livewire\Component;

class Index extends Component
{
    public ServiceAgreement $agreement;
    public $showControls = false;
    protected $listeners = ['refreshProducts' => '$refresh'];

    public function delete(ProductServiceAgreement $productServiceAgreement)
    {
        $productServiceAgreement->delete();
        $this->emitUp('refreshServiceAgreement');
    }

    public function getRowsProperty()
    {
        return ProductServiceAgreement::where('service_agreement_id', $this->agreement->id)->get();
    }

    public function render()
    {
        return view('livewire.admin.service-agreements.products.index', ['products' => $this->rows]);
    }
}
