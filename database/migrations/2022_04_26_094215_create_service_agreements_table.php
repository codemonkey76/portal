<?php

use App\Models\Customer;
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
        Schema::create('service_agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Customer::class)->constrained();
            $table->date('created_at');
            $table->integer('term')->default(1);
            $table->integer('frequency')->default(12);
            $table->decimal('amount')->default(0);
            $table->date('starts_at');
            $table->date('ends_at');
            $table->string('token', 64)->unique()->nullable();
            $table->timestamp('expires_at');

            $table->string('signed_by_name')->nullable();
            $table->string('signed_by_position')->nullable();
            $table->date('signed_at')->nullable();
            $table->string('signature_path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_agreements');
    }
};
