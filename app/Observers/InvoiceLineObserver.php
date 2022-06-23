<?php

namespace App\Observers;

use App\Models\InvoiceLine;

class InvoiceLineObserver
{
    public function saving(InvoiceLine $invoiceLine)
    {
        logger("Running InvoiceLine::saving hook");
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
        logger("Running InvoiceLine::deleting hook");
        $invoice = $invoiceLine->invoice;

        if (!$invoice)
        {
            info("Cannot retrieve invoice for invoiceline");
            info(json_encode($invoiceLine));
            return;
        }

        $subtotalLine = $invoice->subtotalLine;

        $subtotalLine->amount -= $invoiceLine->getOriginal('amount');
        $subtotalLine->save();

        $invoice->total_ex_gst -= $invoiceLine->getOriginal('amount');
        $invoice->save();
    }
}
