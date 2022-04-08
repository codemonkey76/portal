<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super = Role::create(['name' => 'super']);
        $admin = Role::create(['name' => 'admin']);
        $accounts = Role::create(['name' => 'accounts']);
        //$manager = Role::create(['name' => 'manager']);
        $user = Role::create(['name' => 'user']);


        $deleteCustomer = Permission::create(['name' => 'delete customer']);
        $createMenu = Permission::create(['name' => 'create menu']);
        $createPayment = Permission::create(['name' => 'create payment']);
        $makePayment = Permission::create(['name' => 'make payment']);

        $super->givePermissionTo($createMenu);
        $admin->givePermissionTo($deleteCustomer);
        $accounts->givePermissionTo($createPayment);
        $user->givePermissionTo($makePayment);

    }
}
