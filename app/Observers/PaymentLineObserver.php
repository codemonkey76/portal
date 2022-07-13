<?php

namespace App\Observers;

use App\Models\PaymentLine;

class PaymentLineObserver
{
    public function deleting(PaymentLine $paymentLine)
    {
        $invoice = $paymentLine->invoice;
        if($invoice) {
            $invoice->balance += $paymentLine->amount;
            $invoice->save();
        }

        $payment = $paymentLine->payment;

        if ($payment) {
            $payment->unapplied_amount += $paymentLine->amount;
            $payment->save();
        }
    }

    public function saving(PaymentLine $paymentLine)
    {
        $change = $paymentLine->amount - $paymentLine->getOriginal('amount');

        $invoice = $paymentLine->invoice;

        $invoice->balance -= $change;

        $invoice->save();

        $change = $invoice->isAdjustment() ? -$change : $change;

        $payment = $paymentLine->payment;

        $payment->unapplied_amount -= $change;

        $payment->save();
    }
}
