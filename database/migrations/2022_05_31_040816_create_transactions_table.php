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
            $table->decimal('gst')->default(0);
            $table->decimal('total_ex_gst')->default(0);
            $table->text('private_note')->nullable();
            $table->boolean('sync')->default(true);
            $table->integer('sync_failed')->default(0);

            // Invoice specific fields
            $table->foreignIdFor(ServiceAgreement::class)->nullable();
            $table->string('qb_invoice_id')->nullable();
            $table->string('bill_email')->nullable();
            $table->foreignIdFor(Address::class, 'ship_from_address')->nullable();
            $table->foreignIdFor(Address::class, 'ship_address')->nullable();
            $table->foreignIdFor(Address::class, 'bill_address')->nullable();
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
