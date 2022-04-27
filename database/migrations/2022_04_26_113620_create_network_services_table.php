<?php

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
        Schema::create('network_services', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ServiceAgreement::class)->constrained();
            $table->string('service_id')->nullable();
            $table->string('service_type')->nullable();
            $table->string('carrier')->nullable();
            $table->string('username')->nullable();
            $table->string('password')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('end_user')->nullable();
            $table->string('site_name')->nullable();
            $table->string('site_address')->nullable();
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
        Schema::dropIfExists('network_services');
    }
};
