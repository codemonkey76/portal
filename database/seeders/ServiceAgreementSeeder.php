<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\ServiceAgreement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceAgreementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::each(function($customer) {
            if (mt_rand(0,5) === 5)
                ServiceAgreement::factory()->create(['customer_id' => $customer]);
        });
    }
}
