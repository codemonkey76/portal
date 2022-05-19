<?php

namespace Database\Seeders;

use App\Models\NetworkSpeed;
use App\Models\ServiceType;
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

        $nbn = ServiceType::create(['name' => 'NBN']);


        $nbn->speeds()->create([
            'name' => '12Mbps/1Mbps',
            'download' => 12,
            'upload' => 1,
            'price' => 85
        ]);

        $nbn->speeds()->create([
            'name' => '25Mbps/5Mbps',
            'download' => 25,
            'upload' => 5,
            'price' => 97
        ]);

        $nbn->speeds()->create([
            'name' => '50Mbps/20Mbps',
            'download' => 50,
            'upload' => 20,
            'price' => 105
        ]);

        $nbn->speeds()->create([
            'name' => '100Mbps/40Mbps',
            'download' => 100,
            'upload' => 40,
            'price' => 126
        ]);

        $nbn->speeds()->create([
            'name' => '100Mbps/20Mbps',
            'download' => 100,
            'upload' => 20,
            'price' => 122
        ]);

        $nbn->speeds()->create([
            'name' => '250Mbps/25Mbps',
            'download' => 250,
            'upload' => 25,
            'price' => 142
        ]);

        $fibre = ServiceType::create(['name' => 'E-Line']);

        $fibre->speeds()->create([
            'name' => 'Fibre 100Mbps',
            'download' => 100,
            'upload' => 100,
            'price' => 199
        ]);

        $fibre->speeds()->create([
            'name' => 'Fibre 400Mbps',
            'download' => 400,
            'upload' => 400,
            'price' => 399
        ]);

        $fibre->speeds()->create([
            'name' => 'Fibre 1000Mbps',
            'download' => 1000,
            'upload' => 1000,
            'price' => 799
        ]);
    }
}
