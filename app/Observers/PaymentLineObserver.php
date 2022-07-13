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
        logger("Running PaymentLine::saving() hook");
        logger("amount: {$paymentLine->amount}");
        logger("original: {$paymentLine->getOriginal('amount')}");
        $change = $paymentLine->amount - $paymentLine->getOriginal('amount');

        logger("Saving payment line");
        logger("Change: {$change}");

        $invoice = $paymentLine->invoice;
        $type = $invoice->type;


        logger("Updating $type");
        logger("Balance before: {$invoice->balance}");
        $invoice->balance -= $change;

        logger("Balance after: {$invoice->balance}");
        $invoice->save();

        $change = $type === 'adjustment' ? -$change : $change;
        $payment = $paymentLine->payment;

        logger('Updating Payment');
        logger("Unapplied before: {$payment->unapplied_amount}");
        $payment->unapplied_amount -= $change;
        logger("Unapplied after: {$payment->unapplied_amount}");
        $payment->save();

    }
}
