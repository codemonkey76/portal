<?php

namespace Database\Seeders;

use App\Models\Invite;
use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InviteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Customer::each(fn($customer) => Invite::factory(4)->create(['customer_id' => $customer->id]));
    }
}
