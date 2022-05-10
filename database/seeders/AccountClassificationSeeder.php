<?php

namespace Database\Seeders;

use App\Models\AccountClassification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AccountClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AccountClassification::create(['name' => 'Asset']);
        AccountClassification::create(['name' => 'Equity']);
        AccountClassification::create(['name' => 'Expense']);
        AccountClassification::create(['name' => 'Liability']);
        AccountClassification::create(['name' => 'Revenue']);
    }
}
