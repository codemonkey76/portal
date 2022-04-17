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

        $admin->givePermissionTo(Permission::create(['name' => 'delete customer']));

        $super->givePermissionTo(Permission::create(['name' => 'view servers']));

        $super->givePermissionTo(Permission::create(['name' => 'view menus']));
        $super->givePermissionTo(Permission::create(['name' => 'create menus']));
        $super->givePermissionTo(Permission::create(['name' => 'edit menus']));
        $super->givePermissionTo(Permission::create(['name' => 'delete menus']));

        $super->givePermissionTo(Permission::create(['name' => 'view permissions']));
        $super->givePermissionTo(Permission::create(['name' => 'create permissions']));
        $super->givePermissionTo(Permission::create(['name' => 'edit permissions']));
        $super->givePermissionTo(Permission::create(['name' => 'delete permissions']));

        $accounts->givePermissionTo(Permission::create(['name' => 'create payment']));
        $accounts->givePermissionTo(Permission::create(['name' => 'view admin menu']));
        $accounts->givePermissionTo(Permission::create(['name' => 'connect quickbooks']));


        $accounts->givePermissionTo(Permission::create(['name' => 'view admin dashboard']));
        $accounts->givePermissionTo(Permission::create(['name' => 'view customers']));
        $accounts->givePermissionTo(Permission::create(['name' => 'view transactions']));
        $accounts->givePermissionTo(Permission::create(['name' => 'view rate groups']));
        $accounts->givePermissionTo(Permission::create(['name' => 'view plan items']));

        $admin->givePermissionTo(Permission::create(['name' => 'view invites']));
        $admin->givePermissionTo(Permission::create(['name' => 'delete invites']));
        $admin->givePermissionTo(Permission::create(['name' => 'create invites']));
        $admin->givePermissionTo(Permission::create(['name' => 'view users']));
    }
}
