<?php

namespace App\Observers;

use App\Models\InvoiceLine;

class InvoiceLineObserver
{
    public function updating(InvoiceLine $invoiceLine)
    {
        info('Updating invoice line');
        info("Amount: {$invoiceLine->amount}");
        info("Orig Amount: {$invoiceLine->getOriginal('amount')}");

        if ($invoiceLine->detail_type !== 'SalesItemLineDetail') return;

        $invoice = $invoiceLine->invoice;
        $subtotalLine = $invoice->subtotalLine;

        $subtotalLine->amount -= $invoiceLine->getOriginal('amount');
        $subtotalLine->amount += $invoiceLine->amount;
        $subtotalLine->save();

        $invoice->total_ex_gst -= $invoiceLine->getOriginal('amount');
        $invoice->total_ex_gst += $invoiceLine->amount;
        $invoice->save();
    }

    public function deleting(InvoiceLine $invoiceLine)
    {
        info('Deleting invoice line');
        info("Orig Amount: {$invoiceLine->getOriginal('amount')}");

        $invoice = $invoiceLine->invoice;
        $subtotalLine = $invoice->subtotalLine;

        $subtotalLine->amount -= $invoiceLine->getOriginal('amount');
        $subtotalLine->save();

        $invoice->total_ex_gst -= $invoiceLine->getOriginal('amount');
        $invoice->save();
    }
}
