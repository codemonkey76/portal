<?php

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
        Schema::create('payment_lines', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount');
            $table->foreignIdFor(Transaction::class, 'invoice_id')->nullable();
            $table->foreignIdFor(Transaction::class);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_lines');
    }
};
