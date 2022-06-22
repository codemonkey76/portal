<?php

namespace App\Http\Livewire\Admin\Payments;

use App\Models\Customer;
use Livewire\Component;

class Edit extends Component
{
    public $payment;
    public $customers;

    protected function rules()
    {
        return [
            'payment.customer_id' => 'required|exists:customers,id',
            'payment.bill_email' => 'nullable|email',
            'payment.payment_ref' => 'nullable'
        ];
    }

    public function updatedPaymentCustomerId()
    {
        $this->payment->bill_email = Customer::find($this->payment->customer_id)?->email;
    }
    public function mount()
    {
        $this->customers = Customer::orderBy('company_name')->get();
    }

    public function render()
    {
        return view('livewire.admin.payments.edit');
    }
}
