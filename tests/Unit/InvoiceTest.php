<?php

namespace Tests\Unit;

use App\Models\Customer;
use App\Models\InvoiceLine;
use App\Models\Item;
use App\Models\PaymentLine;
use App\Models\Transaction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;

    protected function shouldSeed() : bool
    {
        return true;
    }

    public function test_invoices_can_do_math()
    {
        $customer = Customer::factory()->create();

        $invoice = Transaction::factory()->create(['customer_id' => $customer->id]);
        $this->assertTrue($invoice->total_amount == 0);
        $this->assertTrue($invoice->gst == 0);
        $this->assertTrue($invoice->total_ex_gst == 0);
        $this->assertTrue($invoice->balance == 0);

        InvoiceLine::factory()->subtotal()->create(['transaction_id' => $invoice->id]);
        $invoice->refresh();

        $this->assertTrue($invoice->subtotalLine->amount == 0);

        InvoiceLine::factory()->create([
            'transaction_id' => $invoice->id,
            'amount' => 100,
            'qty' => 1,
            'unit_price' => 100
        ]);

        $invoice->refresh();
        $this->assertTrue($invoice->subtotalLine->amount == 100);

        $this->assertTrue($invoice->total_amount == 110);
        $this->assertTrue($invoice->gst == 10);
        $this->assertTrue($invoice->total_ex_gst == 100);
        $this->assertTrue($invoice->balance == 110);

        InvoiceLine::factory()->create([
            'transaction_id' => $invoice->id,
            'amount' => 250,
            'qty' => 5,
            'unit_price' => 50
        ]);

        $invoice->refresh();
        $this->assertTrue($invoice->subtotalLine->amount == 350);

        $this->assertTrue($invoice->total_amount == 385);
        $this->assertTrue($invoice->gst == 35);
        $this->assertTrue($invoice->total_ex_gst == 350);
        $this->assertTrue($invoice->balance == 385);

        $invoice->invoiceLines()->first()->delete();
        $invoice->refresh();

        $this->assertTrue($invoice->subtotalLine->amount == 250);
        $this->assertTrue($invoice->total_amount == 275);
        $this->assertTrue($invoice->gst == 25);
        $this->assertTrue($invoice->total_ex_gst == 250);
        $this->assertTrue($invoice->balance == 275);
    }

    public function test_invoices_and_payments_can_track_allocations()
    {
        $customer = Customer::factory()->create();
        $invoice = Transaction::factory()->create(['customer_id' => $customer->id]);
        InvoiceLine::factory()->subtotal()->create(['transaction_id' => $invoice->id]);

        InvoiceLine::factory()->create([
            'transaction_id' => $invoice->id,
            'amount' => 100,
            'qty' => 1,
            'unit_price' => 100,
            'line_num' => 1
        ]);
        InvoiceLine::factory()->create([
            'transaction_id' => $invoice->id,
            'amount' => 150,
            'qty' => 3,
            'unit_price' => 50,
            'line_num' => 2
        ]);

        $invoice->refresh();
        $this->assertTrue($invoice->balance == 275);

        $payment = Transaction::factory()->payment()->create([
            'customer_id' => $customer->id,
            'total_amount' => 150,
            'unapplied_amount' => 150
        ]);

        PaymentLine::create([
            'transaction_id' => $payment->id,
            'invoice_id' => $invoice->id,
            'amount' => 100
        ]);

        $invoice->refresh();
        $payment->refresh();

        $this->assertTrue($invoice->balance == 175);
        $this->assertTrue($payment->unapplied_amount == 50);
        $this->assertTrue(true);
    }
}
