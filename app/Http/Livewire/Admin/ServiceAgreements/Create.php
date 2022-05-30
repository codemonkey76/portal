<?php

namespace App\Http\Livewire\Admin\ServiceAgreements;

use App\Http\Livewire\Traits\WithAuthorizationMessage;
use App\Models\Customer;
use App\Models\MobileService;
use App\Models\PaymentFrequency;
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
    public $approximateStartDate;
    public $approximateEndDate;

    public $frequencies;

    public array $terms = [
        1  => 'Monthly',
        6  => '6 Months',
        12 => '12 Months',
        24 => '2 Years',
        36 => '3 Years',
        48 => '4 Years'
    ];

    protected function rules()
    {
        return [
            'agreement.customer_id'       => 'required|exists:customers,id',
            'agreement.created_at'        => 'required|date',
            'agreement.approximate_start' => 'required|date',
            'agreement.approximate_end'   => 'required|date',
            'agreement.frequency'         => 'required|numeric',
            'agreement.term'              => 'required|in:1,6,12,24,36,48'
        ];
    }

    public function updatedAgreementTerm()
    {
        $this->updateApproximateEndDate();
    }

    public function updateApproximateEndDate()
    {
        if ($this->agreement->approximate_start && $this->agreement->term) {
            $this->agreement->approximate_end = $this->agreement->approximate_start->addMonths($this->agreement->term);
            $this->approximateEndDate = $this->agreement->approximate_end->format('Y-m-d');
        }
    }

    public function updatedApproximateStartDate()
    {
        if (!$this->approximateStartDate) {
            $this->agreement->approximate_start = null;
        } else {
            $this->agreement->approximate_start = $this->approximateStartDate;
        }
        $this->updateApproximateEndDate();
    }

    public function createServiceAgreement()
    {
        if (auth()->user()->cannot('service-agreements.create')) {
            return $this->denied();
        }

        $this->validate();
        $this->agreement->save();
        return redirect()->route('service-agreements.edit', $this->agreement->id);
    }

    public function mount()
    {
        $this->created_date = now()->format('Y-m-d');
        $this->agreement = $this->makeBlankAgreement();
        $this->customers = Customer::orderBy('company_name')->get();
        $this->frequencies = PaymentFrequency::all();
        $this->approximateStartsDate = today()->format('Y-m-d');
        $this->updateApproximateEndDate();
    }

    public function updatedCreatedDate()
    {
        $this->agreement->created_at = $this->created_date;
    }

    public function makeBlankAgreement()
    {
        return ServiceAgreement::make([
            'created_at'        => $this->created_date,
            'approximate_start' => today(),
            'frequency'         => 12,
            'term'              => 12,
        ]);
    }

    public function render()
    {
        return view('livewire.admin.service-agreements.create');
    }
}
