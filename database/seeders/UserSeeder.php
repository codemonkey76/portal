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
            'name' => 'Super User',
            'email' => 'super@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret')
        ]);
        $super->assignRole(['super', 'admin', 'accounts', 'user']);

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret')
        ]);
        $admin->assignRole(['admin', 'accounts', 'user']);

        $accounts = User::create([
            'name' => 'Accounts User',
            'email' => 'accounts@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret')
        ]);
        $accounts->assignRole(['accounts', 'user']);

        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret')
        ]);
        $user->assignRole('user');
    }
}
