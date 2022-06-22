<?php

use App\Models\Address;
use App\Models\Account;
use App\Models\Customer;
use App\Models\PaymentMethod;
use App\Models\ServiceAgreement;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {

            //Fields in common between invoices / payments / credits
            $table->id();
            $table->foreignIdFor(Customer::class);
            $table->date('transaction_date');
            $table->string('transaction_ref');
            $table->string('type')->default('invoice');
            $table->string('currency_ref')->default('AUD');
            $table->string('exchange_rate')->default('1')->nullable();
            $table->decimal('total_amount')->default(0);
            $table->decimal('balance')->default(0);
            $table->decimal('gst')->default(0);
            $table->decimal('total_ex_gst')->default(0);
            $table->text('private_note')->nullable();
            $table->boolean('sync')->default(true);
            $table->integer('sync_failed')->default(0);

            // Invoice specific fields
            $table->foreignIdFor(ServiceAgreement::class)->nullable();
            $table->string('qb_invoice_id')->nullable();
            $table->string('bill_email')->nullable();
            $table->string('line1')->nullable();
            $table->string('line2')->nullable();
            $table->string('line3')->nullable();
            $table->string('line4')->nullable();
            $table->string('line5')->nullable();
            $table->string('city')->nullable();
            $table->string('country')->nullable()->default('Australia');
            $table->string('state')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('postal_code_suffix')->nullable();
            $table->string('country_code')->nullable();
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('tag')->nullable();
            $table->string('note')->nullable();
            $table->string('doc_number')->nullable();
            $table->date('ship_date')->nullable();
            $table->string('tracking_num')->nullable();
            $table->date('due_date')->nullable();
            $table->string('customer_memo')->nullable();
            $table->string('ship_method')->nullable();
            $table->boolean('apply_tax_after_discount')->default(false)->nullable();

            // Payment specific fields
            $table->foreignIdFor(Account::class)->nullable();
            $table->foreignIdFor(PaymentMethod::class)->nullable();
            $table->string('qb_payment_id')->nullable();
            $table->decimal('unapplied_amount')->default(0);
            $table->string('payment_ref')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
