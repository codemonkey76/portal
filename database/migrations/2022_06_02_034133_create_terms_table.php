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
        Schema::create('terms', function (Blueprint $table) {
            $table->id();
            $table->string('qb_term_id')->nullable();
            $table->string('name');
            $table->unsignedInteger('discount_percent')->nullable();
            $table->unsignedInteger('discount_days')->nullable();
            $table->boolean('active')->default(true);
            $table->string('type')->nullable();
            $table->unsignedInteger('day_of_month_due')->nullable();
            $table->unsignedInteger('discount_day_of_month')->nullable();
            $table->unsignedInteger('due_next_month_days')->nullable();
            $table->unsignedInteger('due_days')->nullable();
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
        Schema::dropIfExists('terms');
    }
};
