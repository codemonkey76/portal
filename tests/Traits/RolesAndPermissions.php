<?php

namespace Tests\Traits;

use App\Models\User;

trait RolesAndPermissions
{
    public function RolesAndPermissionsSetup()
    {
        User::create([
            'name' => 'Super User',
            'email' => 'super@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret')
        ])->assignRole(['super', 'admin', 'accounts', 'user']);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret')
        ])->assignRole(['admin', 'accounts', 'user']);

        User::create([
            'name' => 'Accounts User',
            'email' => 'accounts@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret')
        ])->assignRole(['accounts', 'user']);

        User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'email_verified_at' => now(),
            'password' => bcrypt('secret')
        ])->assignRole(['user']);
    }

    protected function asAdmin()
    {
        $this->RolesAndPermissionsSetup();
        $this->actingAs(User::whereName('Admin User')->first());
    }

    protected function asRegular()
    {
        $this->RolesAndPermissionsSetup();
        $this->actingAs(User::whereName('Regular User')->first());
    }

    protected function asSuper()
    {
        $this->RolesAndPermissionsSetup();
        $this->actingAs(User::whereName('Super User')->first());
    }
}
