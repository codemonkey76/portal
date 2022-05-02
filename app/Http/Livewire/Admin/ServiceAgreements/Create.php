<?php

namespace App\Http\Livewire\Admin\ServiceAgreements;

use App\Http\Livewire\Traits\WithAuthorizationMessage;
use App\Models\Customer;
use App\Models\MobileService;
use App\Models\ServiceAgreement;
use App\Models\ServiceProvider;
use Livewire\Component;

class Create extends Component
{
    use WithAuthorizationMessage;

    public ServiceAgreement $agreement;

    public $created_date;
    public $customers;
    public $contract_term;
    public $startsAtDate;
    public $endsAtDate;

    public $terms = [
        1 => 'Monthly',
        6 => '6 Months',
        12 => '12 Months',
        24 => '2 Years',
        36 => '3 Years',
        48 => '4 Years'
    ];
    protected function rules() {
        return [
            'agreement.customer_id' => 'required|exists:customers,id',
            'agreement.created_at' => 'required|date',
            'agreement.starts_at' => 'required|date',
            'agreement.ends_at' => 'required|date',
            'contract_term' => 'required|in:1,6,12,24,36,48'
        ];
    }

    public function updatedContractTerm()
    {
        $this->updateEndsAtDate();
    }

    public function updateEndsAtDate()
    {
        if ($this->agreement->starts_at && $this->contract_term) {
            $this->agreement->ends_at = $this->agreement->starts_at->addMonths($this->contract_term);
            $this->endsAtDate = $this->agreement->ends_at->format('Y-m-d');
        }
    }

    public function updatedStartsAtDate()
    {
        if (!$this->startsAtDate)
            $this->agreement->starts_at = null;
        else
            $this->agreement->starts_at = $this->startsAtDate;
        $this->updateEndsAtDate();
    }

    public function createServiceAgreement()
    {
        if (auth()->user()->cannot('service-agreements.create')) return $this->denied();

        $this->validate();
        $this->agreement->save();
        return redirect()->route('service-agreements.edit', $this->agreement->id);
    }

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
