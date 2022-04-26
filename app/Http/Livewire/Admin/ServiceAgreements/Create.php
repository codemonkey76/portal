<?php

namespace App\Http\Livewire\Admin\ServiceAgreements;

use App\Models\Customer;
use App\Models\ServiceAgreement;
use Livewire\Component;

class Create extends Component
{
    public ServiceAgreement $agreement;


    public $created_date;
    public $agreement_type;
    public $customers;

    public $agreementTypes = [
        1 => 'Mobile Service',
        2 => 'Network Service',
        3 => 'VOIP Service'
    ];

    protected $rules = [
        'created_date' => 'required|date',
        'agreement.customer_id' => 'required|exists:customers,id',
        'agreement_type' => 'required|number'
    ];

    public function mount()
    {
        $this->created_date = now()->format('Y-m-d');
        $this->agreement = $this->makeBlankAgreement();
        $this->customers = Customer::orderBy('company_name')->get();
    }

    public function updatedCreatedDate()
    {
        $this->agreement->created_at = $this->created_date;
    }

    public function makeBlankAgreement()
    {
        return ServiceAgreement::make(['created_at' => $this->created_date]);
    }
    public function render()
    {
        return view('livewire.admin.service-agreements.create');
    }
}
