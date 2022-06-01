<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super = User::create([
            'name' => config('app.super.name'),
            'email' => config('app.super.login'),
            'email_verified_at' => now(),
            'password' => bcrypt(config('app.super.password'))
        ]);

        $super->assignRole(['super', 'admin', 'accounts', 'user']);
    }
}
