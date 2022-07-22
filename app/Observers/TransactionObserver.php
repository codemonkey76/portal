<?php

namespace App\Observers;

use App\Models\GlobalSetting;
use App\Models\Transaction;

class TransactionObserver
{

    public function creating(Transaction $transaction): void
    {
        $transaction->transaction_ref = match ($transaction->type) {
            'invoice' => GlobalSetting::getNextInvoiceNo(),
            'payment' => GlobalSetting::getNextPaymentNo(),
            'adjustment' => GlobalSetting::getNextAdjustmentNo()
        };
        $transaction->gst = 0;
        $transaction->total_amount = 0;
        $transaction->balance = 0;

        if ($transaction->type === 'payment')
            $transaction->unapplied_amount = $transaction->total_ex_gst ?? 0;
    }

    public function saving(Transaction $transaction): void
    {
        if ($transaction->type === 'payment')
        {
            $applied = $transaction->paymentLines()->sum('amount');
            $transaction->unapplied_amount = ($transaction->total_ex_gst ?? 0) - $applied;
            return;
        }

        $transaction->gst = $transaction->total_ex_gst * 0.1;
        $transaction->total_amount = $transaction->total_ex_gst + $transaction->gst;
        $change = $transaction->total_amount - $transaction->getOriginal('total_amount');
        $transaction->balance += $change;
    }

    public function deleting(Transaction $transaction): void
    {
        // If deleting an invoice, delete all the invoice lines, and remove any payment allocations that were allocated to it.

        if (!$transaction->isInvoice()) return; //not yet supported

        $transaction->invoiceLines()->delete();
        $transaction->subtotalLine()->delete();

        $transaction->payments()->each(function($paymentLine) {
            $paymentLine->delete();
        });
    }
}
