<?php

namespace App\Http\Livewire\Admin\Invoices;

use App\Models\Transaction;
use Livewire\Component;

class Edit extends Component
{

    public $invoice;
    public $show = true;

    protected $listeners = ['editInvoice'];

    public function editInvoice(Transaction $transaction)
    {
        $this->notify("Editing invoice ID: {$transaction->transaction_ref}");
        $this->invoice = $transaction;
    }
    public function render()
    {
        return view('livewire.admin.invoices.edit');
    }
}
