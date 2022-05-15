<?php

namespace Database\Seeders;

use App\Models\NetworkSpeed;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NetworkSpeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NetworkSpeed::create([
            'name' => '12Mbps/1Mbps',
            'download' => 12,
            'upload' => 1
        ]);

        NetworkSpeed::create([
            'name' => '25Mbps/5Mbps',
            'download' => 25,
            'upload' => 5
        ]);

        NetworkSpeed::create([
            'name' => '50Mbps/20Mbps',
            'download' => 50,
            'upload' => 20
        ]);

        NetworkSpeed::create([
            'name' => '100Mbps/40Mbps',
            'download' => 100,
            'upload' => 40
        ]);

        NetworkSpeed::create([
            'name' => '100Mbps/20Mbps',
            'download' => 100,
            'upload' => 20
        ]);

        NetworkSpeed::create([
            'name' => '250Mbps/20Mbps',
            'download' => 250,
            'upload' => 20
        ]);

        NetworkSpeed::create([
            'name' => 'Fibre 100Mbps',
            'download' => 100,
            'upload' => 100
        ]);

        NetworkSpeed::create([
            'name' => 'Fibre 400Mbps',
            'download' => 400,
            'upload' => 400
        ]);

        NetworkSpeed::create([
            'name' => 'Fibre 1000Mbps',
            'download' => 1000,
            'upload' => 1000
        ]);

    }
}
