<?php

use App\Models\Item;
use App\Models\TaxRate;
use App\Models\Transaction;
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
        Schema::create('invoice_lines', function (Blueprint $table) {
            $table->id();
            $table->string('detail_type')->default('SalesItemLine');
            $table->decimal('amount')->default(0)->nullable();
            $table->string('description', 4000)->nullable();
            $table->decimal('tax_inclusive_amount')->default(0);
            $table->decimal('discount_amount')->nullable();
            $table->foreignIdFor(Item::class)->nullable();
            $table->foreignIdFor(TaxRate::class)->nullable();
            $table->date('service_date')->nullable();
            $table->decimal('discount_rate')->nullable();
            $table->decimal('qty')->nullable();
            $table->decimal('unit_price')->nullable();
            $table->integer('line_num')->default(1)->nullable();
            $table->foreignIdFor(Transaction::class);
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
        Schema::dropIfExists('invoice_lines');
    }
};
