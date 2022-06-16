<?php

namespace App\Observers;

use App\Models\GlobalSetting;
use App\Models\Transaction;

class TransactionObserver
{

    public function creating(Transaction $transaction): void
    {
        logger("Running Transaction::creating hook");
        $transaction->transaction_ref = match ($transaction->type) {
            'invoice' => GlobalSetting::getNextInvoiceNo(),
            'payment' => GlobalSetting::getNextPaymentNo()
        };
    }

    public function saving(Transaction $transaction): void
    {
        if (!$transaction->isInvoice())
        {
            return;
        }

        $transaction->gst = $transaction->total_ex_gst * 0.1;
        $transaction->total_amount = $transaction->total_ex_gst + $transaction->gst;
        $change = $transaction->total_amount - $transaction->getOriginal('total_amount');
        $transaction->balance += $change;
    }

    public function deleting(Transaction $transaction): void
    {
        logger("Running Transaction::deleting hook");
        // If deleting an invoice, delete all the invoice lines, and remove any payment allocations that were allocated to it.

        if (!$transaction->isInvoice()) return; //not yet supported

        $transaction->invoiceLines()->delete();
        $transaction->subtotalLine()->delete();

        $transaction->payments()->each(function($paymentLine) {
            $paymentLine->delete();
        });
    }
}
