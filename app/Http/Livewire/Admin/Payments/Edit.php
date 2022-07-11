<?php

namespace App\Http\Livewire\Admin\Payments;

use Akaunting\Money\Money;
use App\Models\Customer;
use App\Models\PaymentAllocation;
use App\Models\PaymentAllocationLine;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class Edit extends Component
{
    public $payment;

    public $customers;
    public $transaction_date;

    public $editingAllocationIndex = null;

    public $allocations;

    protected function rules()
    {
        return [
            'payment.customer_id' => ['required'],
            'payment.bill_email' => '',
            'payment.payment_ref' => '',
            'payment.total_ex_gst' => ['required', 'numeric'],
            'allocations.*.amount' => ['required']
        ];
    }

//    protected $validationAttributes = [
//        'allocations.*.amount' => 'amount'
//    ];

    public function updatedTransactionDate()
    {
        $this->payment->transaction_date = $this->transaction_date;
    }

    public function updatedPaymentCustomerId()
    {
        $this->payment->bill_email = Customer::find($this->payment->customer_id)?->email;
    }

    public function getAllocationBalance($allocation)
    {
        return $allocation->transaction->getBalanceExcludingPayment($this->payment);
    }

    public function allocate(PaymentAllocationLine $paymentAllocationLine)
    {
        // Get remaining payment
        $remainingPayment = $this->payment->total_ex_gst - collect($this->allocations)->sum('amount');

        // If invoice is fully paid, clear allocation
        if ($this->getAllocationBalance($paymentAllocationLine) == $paymentAllocationLine->amount)
            return $this->setAllocationAmount($paymentAllocationLine, 0, false);

        // Check if invoice is partially paid
        if ($paymentAllocationLine->amount != 0)
        {

            // If the payment is already fully paid, remove this allocation
            if ($remainingPayment == 0)
                return $this->setAllocationAmount($paymentAllocationLine, 0);

            // If payment remaining less than invoice remaining, add payment remaining to amount
            if ($remainingPayment < ($paymentAllocationLine->transaction->total_amount - $paymentAllocationLine->amount))
                return $this->setAllocationAmount($paymentAllocationLine, $remainingPayment, true);

            // Payment can fully pay the invoice

            return $this->setAllocationAmount($paymentAllocationLine, $paymentAllocationLine->transaction->total_amount);
        }

        // payment allocation is currently 0
        // If payment remaining less than invoice remaining, add payment_remaining to amount
        if ($remainingPayment < ($paymentAllocationLine->transaction->total_amount - $paymentAllocationLine->amount))
            return $this->setAllocationAmount($paymentAllocationLine, $remainingPayment, true);

        //payment amount can fully cover the invoice
        return $this->setAllocationAmount($paymentAllocationLine, $paymentAllocationLine->transaction->total_amount);
    }


    public function setAllocationAmount($allocation, $amount, $addToExisting = false): int
    {
        $allocation->amount = $addToExisting ? $allocation->amount + $amount: $amount;
        $allocation->save();
        $this->allocations = $this->getAllocations();

        return 0;
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

        $this->allocations = $this->getAllocations();
    }


    public function editAllocation($index)
    {
        $this->editingAllocationIndex = $index;
    }



    public function saveAllocation()
    {
        $allocated = collect($this->allocations)->sum('amount');

        if ($allocated > $this->payment->total_ex_gst) {
            throw ValidationException::withMessages([
                'amount' => ['The allocations are larger than the payment amount.']
            ]);
        }

        $this->allocations[$this->editingAllocationIndex]->save();
        $this->notify("Saving allocations");

        $this->editingAllocationIndex = null;
    }

    public function getAllocations()
    {
        return auth()
            ->user()
            ->paymentAllocation
            ->paymentAllocationLines()
            ->with('transaction')
            ->get();
    }

    public function render()
    {
        return view('livewire.admin.payments.edit');
    }
}
