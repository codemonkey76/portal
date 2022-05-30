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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->foreignIdFor(Customer::class);
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
            $table->string('type')->nullable();

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
        Schema::dropIfExists('addresses');
    }
};
