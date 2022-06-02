<?php

namespace App\Http\Livewire\Admin\Invoices;

use App\Models\Customer;
use App\Models\Term;
use App\Models\Transaction;
use Livewire\Component;

class Edit extends Component
{

    public $invoice;
    public $show = true;
    public $customers;
    public $terms;
    public $term_id;
    public $transaction_date;
    public $due_date;
    protected $listeners = ['editInvoice'];

    protected function rules()
    {
        return [
            'invoice.customer_id' => 'required|exists:customers,id',
            'invoice.bill_email' => 'required|email',
            'invoice.transaction_date' => 'required|date',
            'invoice.due_date' => 'required|date',
            'transaction_date' => '',
            'due_date' => '',
            'term_id' => ''
        ];
    }

    public function updatedInvoiceCustomerId()
    {
        $customer = Customer::find($this->invoice->customer_id);

        if ($customer)
        {
            $this->invoice->bill_email = $customer->email;
            $this->term_id = $customer->term_id;
            $this->invoice->due_date = $customer->terms?->getDueDate($this->invoice->transaction_date);
        }

        $this->notify($this->invoice->transaction_date);
    }

    public function updatedDueDate()
    {
        $this->invoice->due_date = $this->due_date;
    }

    public function updatedTransactionDate()
    {
        $this->invoice->transaction_date = $this->transaction_date;
    }

    public function editInvoice(Transaction $transaction)
    {
        $this->notify("Editing invoice ID: {$transaction->transaction_ref}");
        $this->invoice = $transaction;
    }

    public function mount()
    {
        $this->customers = Customer::orderBy('company_name')->get();
        $this->terms = Term::orderBy('name')->get();
        $this->term_id = $this->invoice->customer->term_id;
        $this->transaction_date = $this->invoice->transaction_date->format('Y-m-d');
        $this->due_date = $this->invoice->due_date->format('Y-m-d');
    }
    public function render()
    {
        return view('livewire.admin.invoices.edit');
    }
}
