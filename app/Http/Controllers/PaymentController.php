<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Transaction::class, 'payment');
    }

    public function edit(Transaction $payment)
    {

        return view('payments.edit', ['payment' => $payment]);
    }
}
