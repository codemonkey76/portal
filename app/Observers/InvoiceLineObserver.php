<?php

namespace App\Observers;

use App\Models\InvoiceLine;

class InvoiceLineObserver
{
    public function saving(InvoiceLine $invoiceLine)
    {
        if ($invoiceLine->detail_type !== 'SalesItemLineDetail') return;

        $invoice = $invoiceLine->invoice;
        $subtotalLine = $invoice->subtotalLine;

        if ($subtotalLine) {
            $subtotalLine->amount -= $invoiceLine->getOriginal('amount');
            $subtotalLine->amount += $invoiceLine->amount;
            $subtotalLine->save();
        }

        $invoice->total_ex_gst -= $invoiceLine->getOriginal('amount');
        $invoice->total_ex_gst += $invoiceLine->amount;
        $invoice->save();
    }

    public function deleting(InvoiceLine $invoiceLine)
    {
        $invoice = $invoiceLine->invoice;

        if (!$invoice) return;

        $subtotalLine = $invoice->subtotalLine;

        $subtotalLine->amount -= $invoiceLine->getOriginal('amount');
        $subtotalLine->save();

        $invoice->total_ex_gst -= $invoiceLine->getOriginal('amount');
        $invoice->save();
    }
}
