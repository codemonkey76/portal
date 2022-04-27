<?php

namespace Database\Seeders;

use App\Models\NetworkService;
use App\Models\ServiceAgreement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NetworkServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceAgreement::each(function($agreement) {
            NetworkService::factory()->create(['service_agreement_id' => $agreement->id]);
        });
    }
}
