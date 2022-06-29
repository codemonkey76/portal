<?php

use App\Models\PaymentAllocation;
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
        Schema::create('payment_allocation_lines', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PaymentAllocation::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Transaction::class)->constrained()->onDelete('cascade');
            $table->decimal('amount')->default(0);
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
        Schema::dropIfExists('payment_allocation_lines');
    }
};
