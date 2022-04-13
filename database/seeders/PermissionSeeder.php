<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
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
        Schema::disableForeignKeyConstraints();
        Role::truncate();
        Permission::truncate();
        Schema::enableForeignKeyConstraints();

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $super = Role::create(['name' => 'super']);
        $admin = Role::create(['name' => 'admin']);
        $accounts = Role::create(['name' => 'accounts']);

        $user = Role::create(['name' => 'user']);


        $deleteCustomer = Permission::create(['name' => 'delete customer']);
        $createMenu = Permission::create(['name' => 'create menu']);
        $createPayment = Permission::create(['name' => 'create payment']);
        $makePayment = Permission::create(['name' => 'make payment']);

        $viewAdminMenu = Permission::create(['name' => 'view admin menu']);
        $connectQuickbooks = Permission::create(['name' => 'connect quickbooks']);
        $listUsers = Permission::create(['name' => 'list users']);
        $listInvites = Permission::create(['name' => 'list invites']);

        $super->givePermissionTo($createMenu);
        $admin->givePermissionTo($deleteCustomer);


        $accounts->givePermissionTo($createPayment);
        $accounts->givePermissionTo($viewAdminMenu);
        $accounts->givePermissionTo($connectQuickbooks);
        $accounts->givePermissionTo($listUsers);
        $accounts->givePermissionTo($listInvites);

        $user->givePermissionTo($makePayment);

    }
}
