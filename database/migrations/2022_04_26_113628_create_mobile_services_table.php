<?php

use App\Models\ServiceAgreement;
use App\Models\ServiceProvider;
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
        Schema::create('mobile_services', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ServiceAgreement::class)->constrained();
            $table->string('mobile_number');
            $table->foreignIdFor(ServiceProvider::class)->constrained();
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
        Schema::dropIfExists('mobile_services');
    }
};
