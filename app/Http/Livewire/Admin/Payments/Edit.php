<?php

namespace App\Http\Livewire\Admin\Payments;

use Akaunting\Money\Money;
use App\Models\Customer;
use App\Models\PaymentAllocation;
use Livewire\Component;

class Edit extends Component
{
    public $payment;

    public $customers;
    public $transaction_date;

    public $editingAllocationIndex = null;

    public $allocations = [];

    protected $rules =  [
        'allocations.*.amount' => ['required', 'numeric']
    ];

    protected $validationAttributes = [
        'allocations.*.amount' => 'amount'
    ];

    public function updatedTransactionDate()
    {
        $this->payment->transaction_date = $this->transaction_date;
    }

    public function updatedPaymentCustomerId()
    {
        $this->payment->bill_email = Customer::find($this->payment->customer_id)?->email;
    }

    public function allocate($allocationId)
    {
        info($allocationId);
        $this->notify($allocationId);
        $allocation = $this->allocations->where('id', '=' ,$allocationId)->first();
        $this->notify(json_encode($allocation));
        //$this->notify("Current allocation: " . $allocation->allocation);
        //$this->notify("Remaining payment to allocate: " . $this->payment->total_amount);
    }
    public function checkStatus($allocation)
    {
        return $allocation->balance == 0 ? 'true' : 'false';
    }

    public function formatDate($date)
    {
        return $date?->format('d/m/Y');
    }

    public function formatCurrency($amount)
    {
        return Money::AUD($amount * 100)->format();
    }

    public function mount()
    {
        $this->customers = Customer::orderBy('company_name')->get();
        $this->transaction_date = $this->payment->transaction_date->format('Y-m-d');
        $userId = auth()->id();

        //Delete any existing allocations
        PaymentAllocation::whereUserId($userId)->delete();

        // Create new allocations for user
        $alloc = PaymentAllocation::create(['user_id' => $userId, 'transaction_id' => $this->payment->id]);

        // Create allocation lines that match payment lines
        $payment = $this->payment;
        $payment
            ->customer
            ->transactions()
            ->outstanding($payment)
            ->each(function ($transaction) use ($alloc, $payment) {
                $alloc->paymentAllocationLines()->create([
                    'transaction_id' => $transaction->id,
                    'amount' => $payment->paymentLines()->whereInvoiceId($transaction->id)->first()?->amount ?? 0
                ]);
        });

        $this->allocations = auth()
            ->user()
            ->paymentAllocation
            ->paymentAllocationLines()
            ->with('transaction')
            ->get()
            ->toArray();
    }

    public function editAllocation($index)
    {
        $this->editingAllocationIndex = $index;
    }

    public function saveAllocation()
    {

        $this->notify(json_encode($this->allocations[$this->editingAllocationIndex]));
//        $this->notify("Saving");
        $this->editingAllocationIndex = null;
    }

    public function render()
    {
        return view('livewire.admin.payments.edit');
    }
}
