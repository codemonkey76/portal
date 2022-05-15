<?php

namespace Database\Seeders;

use App\Models\NetworkCarrier;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NetworkCarrierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NetworkCarrier::create(['name' => 'Superloop']);
        NetworkCarrier::create(['name' => 'AAPT']);
        NetworkCarrier::create(['name' => 'Optus (Bundled-AGVC-L3)']);
    }
}
