<?php

namespace Database\Seeders;

use App\Models\NetworkService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(CustomerSeeder::class);
        $this->call(TestimonialSeeder::class);
        $this->call(FeatureSeeder::class);
        $this->call(QuestionSeeder::class);
        $this->call(VoipServerSeeder::class);
        $this->call(ServiceAgreementSeeder::class);
        $this->call(ServiceProviderSeeder::class);
        $this->call(NetworkServiceSeeder::class);
        $this->call(MobileServiceSeeder::class);
        $this->call(GlobalSettingSeeder::class);
    }
}
