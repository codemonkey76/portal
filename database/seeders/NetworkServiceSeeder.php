<?php

namespace Database\Seeders;

use App\Models\NetworkService;
use App\Models\ServiceAgreement;
use App\Models\ServiceProvider;
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
            $serviceProviderId = ServiceProvider::inRandomOrder()->first()->id;
            NetworkService::factory()->create(['service_agreement_id' => $agreement->id, 'service_provider_id' => $serviceProviderId]);
        });
    }
}
