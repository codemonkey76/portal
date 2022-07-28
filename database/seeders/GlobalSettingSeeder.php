<?php

namespace Database\Seeders;

use App\Models\GlobalSetting;
use Illuminate\Database\Seeder;

class GlobalSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GlobalSetting::create([
            'key' => 'company_name',
            'value' => 'ASG Communications Pty Ltd'
        ]);

        GlobalSetting::create([
            'key' => 'abn',
            'value' => '44 642 768 643'
        ]);

        GlobalSetting::create([
            'key' => 'address',
            'value' => '1/48 Lillian Ave, Salisbury QLD 4107'
        ]);

        GlobalSetting::create([
            'key' => 'next_invoice_no',
            'value' => 'INV-01000'
        ]);

        GlobalSetting::create([
            'key' => 'next_payment_no',
            'value' => 'PAY-01000'
        ]);

        GlobalSetting::create([
            'key' => 'next_adjustment_no',
            'value' => 'ADJ-01000'
        ]);

        GlobalSetting::create([
            'key' => 'default_payment_terms',
            'value' => 'Net 30'
        ]);

        GlobalSetting::create([
            'key' => 'global_task_in_progress',
            'value' => 'false'
        ]);
    }
}
