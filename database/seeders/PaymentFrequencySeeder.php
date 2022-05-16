<?php

namespace Database\Seeders;

use App\Models\PaymentFrequency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentFrequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentFrequency::create(['name' => 'Weekly', 'value' => 52]);
        PaymentFrequency::create(['name' => 'Fortnightly', 'value' => 26]);
        PaymentFrequency::create(['name' => 'Monthly', 'value' => 12]);
        PaymentFrequency::create(['name' => 'Quarterly', 'value' => 4]);
        PaymentFrequency::create(['name' => 'Yearly', 'value' => 1]);
    }
}
