<?php

namespace App\Observers;

use App\Models\PaymentLine;

class PaymentLineObserver
{
    public function deleting(PaymentLine $paymentLine)
    {
        logger("Running PaymentLine::deleting hook");
    }

    public function saving(PaymentLine $paymentLine)
    {
        $change = $paymentLine->amount - $paymentLine->getOriginal('amount');
        $invoice = $paymentLine->invoice;
        $payment = $paymentLine->payment;

        $invoice->balance -= $change;
        $invoice->save();

        $payment->unapplied_amount -= $change;
        $payment->save();
    }
}
