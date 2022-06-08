<?php

namespace App\Observers;

use App\Models\InvoiceLine;

class InvoiceLineObserver
{
    public function updating(InvoiceLine $invoiceLine)
    {
        $invoice = $invoiceLine->invoice;
        $invoice->total_amount -= $invoiceLine->getOriginal('amount');
        $invoice->total_amount += $invoiceLine->amount;

        $invoice->save();
    }
}
