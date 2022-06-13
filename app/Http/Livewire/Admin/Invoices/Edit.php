<?php

namespace App\Http\Livewire\Admin\Invoices;

use App\Models\Customer;
use App\Models\GlobalSetting;
use App\Models\InvoiceLine;
use App\Models\Term;
use App\Models\Transaction;
use Livewire\Component;

class Edit extends Component
{

    public $invoice;
    public $show = true;
    public $customers;
    public $default_term;
    public $terms;
    public $term_id;
    public $transaction_date;
    public $due_date;
    public $editing;
    public $deleting;

    public $showEditModal = false;
    public $showDeleteModal = false;

    protected $listeners = ['editInvoice'];

    protected function rules()
    {
        return [
            'invoice.customer_id' => 'required|exists:customers,id',
            'invoice.bill_email' => 'required|email',
            'invoice.transaction_date' => 'required|date',
            'invoice.due_date' => 'required|date',
            'invoice.doc_number' => '',
            'transaction_date' => '',
            'invoice.customer_memo' => '',
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
            $term = $customer->term;

            if (!$term)
            {
                $this->term_id = $this->default_term->id;
                $this->invoice->due_date = $this->default_term->getDueDate($this->invoice->transaction_date);
            }
            if ($term)
            {
                $this->term_id = $customer->term_id;
                $this->invoice->due_date = $term->getDueDate($this->invoice->transaction_date);
            }
        }
    }

    public function updatedDueDate()
    {
        $this->invoice->due_date = $this->due_date;
    }

    public function updatedTransactionDate()
    {
        $this->invoice->transaction_date = $this->transaction_date;
    }

    public function updatedTermId()
    {
        $terms = Term::find($this->term_id);

        $this->invoice->due_date = $terms->getDueDate($this->invoice->transaction_date);
        $this->due_date = $this->invoice->due_date->format('Y-m-d');
    }

    public function editInvoice(Transaction $transaction)
    {
    }

    public function editLine(InvoiceLine $line)
    {
        $this->emit('showEditInvoiceLineModal', [$line]);
    }

    public function confirmDelete(InvoiceLine $line)
    {
        $this->deleting = $line;
        $this->showDeleteModal = true;
    }

    public function delete()
    {
        $this->deleting->delete();
        $this->showDeleteModal = false;
        $this->notify("Line deleted successfully!");
    }

    public function mount()
    {
        $this->customers = Customer::orderBy('company_name')->get();
        $this->terms = Term::orderBy('name')->get();
        $this->term_id = $this->invoice->customer->term_id;
        $this->transaction_date = $this->invoice->transaction_date->format('Y-m-d');
        $this->due_date = $this->invoice->due_date?->format('Y-m-d');
        $this->default_term = Term::whereName(GlobalSetting::whereKey('default_payment_terms')->first()->value)->first();
    }
    public function render()
    {
        return view('livewire.admin.invoices.edit');
    }
}
