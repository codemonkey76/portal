<?php

namespace Database\Seeders;

use App\Models\VoipServer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoipServerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VoipServer::factory(10)->create();
    }
}
