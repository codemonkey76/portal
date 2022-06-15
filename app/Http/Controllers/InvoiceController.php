<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class InvoiceController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Transaction::class, 'invoice');
    }

    public function edit(Transaction $invoice)
    {

        return view('invoices.edit', ['invoice' => $invoice]);
    }
}
