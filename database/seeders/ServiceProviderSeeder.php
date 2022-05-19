<?php

namespace Database\Seeders;

use App\Models\ServiceProvider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceProviderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ServiceProvider::create(['name' => 'Optus', 'type' => 'mobile']);
        ServiceProvider::create(['name' => 'Superloop', 'type' => 'network']);
        ServiceProvider::create(['name' => 'AAPT', 'type' => 'network']);
        ServiceProvider::create(['name' => 'Optus (Bundled-AGVC-L3)', 'type' => 'network']);
    }
}
