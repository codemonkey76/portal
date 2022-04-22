<?php

use App\Models\VoipRateGroup;
use App\Models\VoipServer;
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
        Schema::create('voip_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('domain_name');
            $table->foreignIdFor(VoipServer::class)->constrained();
            $table->decimal('max_daily_spend')->default(20);
            $table->foreignIdFor(VoipRateGroup::class)->constrained();

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
        Schema::dropIfExists('voip_accounts');
    }
};
