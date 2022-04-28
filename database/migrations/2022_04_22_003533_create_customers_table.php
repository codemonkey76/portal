<?php

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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('fully_qualified_name');
            $table->string('company_name')->nullable();
            $table->string('abn')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('billing_suburb')->nullable();
            $table->string('billing_state')->nullable();
            $table->string('billing_postcode')->nullable();
            $table->string('billing_country')->nullable();
            $table->string('display_name');
            $table->boolean('active')->default(true);
            $table->boolean('taxable')->default(true);
            $table->integer('terms')->default(15);
            $table->decimal('starting_balance')->default(0);
            $table->decimal('credit_limit')->default(1000);
            $table->string('qb_customer_id')->nullable();
            $table->boolean('sync')->default(true);
            $table->integer('sync_failed')->default(0);
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
        Schema::dropIfExists('customers');
    }
};
