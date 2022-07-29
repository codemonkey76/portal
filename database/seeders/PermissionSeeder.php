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

        $admin = Role::create(['name' => 'admin']);
        $accounts = Role::create(['name' => 'accounts']);

        $user = Role::create(['name' => 'user']);

        $admin->givePermissionTo(Permission::create(['name' => 'customers.create']));

        $super = Role::create(['name' => 'super']);

        $super->givePermissionTo(Permission::create(['name' => 'menus.index']));
        $super->givePermissionTo(Permission::create(['name' => 'menus.create']));
        $super->givePermissionTo(Permission::create(['name' => 'menus.update']));
        $super->givePermissionTo(Permission::create(['name' => 'menus.destroy']));

        $super->givePermissionTo(Permission::create(['name' => 'permissions.index']));
        $super->givePermissionTo(Permission::create(['name' => 'permissions.create']));
        $super->givePermissionTo(Permission::create(['name' => 'permissions.update']));
        $super->givePermissionTo(Permission::create(['name' => 'permissions.destroy']));

        $super->givePermissionTo(Permission::create(['name' => 'voip-servers.create']));
        $super->givePermissionTo(Permission::create(['name' => 'voip-servers.index']));
        $super->givePermissionTo(Permission::create(['name' => 'voip-servers.update']));
        $super->givePermissionTo(Permission::create(['name' => 'voip-servers.destroy']));

        $super->givePermissionTo(Permission::create(['name' => 'roles.index']));
        $super->givePermissionTo(Permission::create(['name' => 'roles.create']));
        $super->givePermissionTo(Permission::create(['name' => 'roles.update']));
        $super->givePermissionTo(Permission::create(['name' => 'roles.destroy']));
        $super->givePermissionTo(Permission::create(['name' => 'roles.assign']));

        $accounts->givePermissionTo(Permission::create(['name' => 'payments.create']));
        $accounts->givePermissionTo(Permission::create(['name' => 'view admin menu']));
        $accounts->givePermissionTo(Permission::create(['name' => 'connect quickbooks']));
        $accounts->givePermissionTo(Permission::create(['name' => 'service-agreements.index']));
        $accounts->givePermissionTo(Permission::create(['name' => 'service-agreements.create']));
        $accounts->givePermissionTo(Permission::create(['name' => 'service-agreements.update']));

        $accounts->givePermissionTo(Permission::create(['name' => 'transactions.index']));
        $accounts->givePermissionTo(Permission::create(['name' => 'transactions.update']));
        $accounts->givePermissionTo(Permission::create(['name' => 'transactions.void']));
        $accounts->givePermissionTo(Permission::create(['name' => 'transactions.show']));
        $accounts->givePermissionTo(Permission::create(['name' => 'transactions.send']));
        $accounts->givePermissionTo(Permission::create(['name' => 'transactions.delete']));
        $accounts->givePermissionTo(Permission::create(['name' => 'transactions.copy']));

        $accounts->givePermissionTo(Permission::create(['name' => 'view admin dashboard']));
        $accounts->givePermissionTo(Permission::create(['name' => 'customers.index']));
        $accounts->givePermissionTo(Permission::create(['name' => 'customers.show']));
        $accounts->givePermissionTo(Permission::create(['name' => 'customers.update']));
        $accounts->givePermissionTo(Permission::create(['name' => 'customers.delete']));

        $accounts->givePermissionTo(Permission::create(['name' => 'rate-groups.index']));
        $accounts->givePermissionTo(Permission::create(['name' => 'plan-items.index']));
        $accounts->givePermissionTo(Permission::create(['name' => 'service-providers.index']));

        $accounts->givePermissionTo(Permission::create(['name' => 'items.index']));
        $accounts->givePermissionTo(Permission::create(['name' => 'items.update']));
        $accounts->givePermissionTo(Permission::create(['name' => 'items.destroy']));
        $accounts->givePermissionTo(Permission::create(['name' => 'items.create']));

        $accounts->givePermissionTo(Permission::create(['name' => 'products.index']));
        $accounts->givePermissionTo(Permission::create(['name' => 'products.update']));
        $accounts->givePermissionTo(Permission::create(['name' => 'products.destroy']));
        $accounts->givePermissionTo(Permission::create(['name' => 'products.create']));

        $accounts->givePermissionTo(Permission::create(['name' => 'accounts.index']));
        $accounts->givePermissionTo(Permission::create(['name' => 'accounts.update']));
        $accounts->givePermissionTo(Permission::create(['name' => 'accounts.destroy']));
        $accounts->givePermissionTo(Permission::create(['name' => 'accounts.create']));
        $accounts->givePermissionTo(Permission::create(['name' => 'quickbooks.utilities']));

        $admin->givePermissionTo(Permission::create(['name' => 'invites.index']));
        $admin->givePermissionTo(Permission::create(['name' => 'invites.destroy']));
        $admin->givePermissionTo(Permission::create(['name' => 'invites.create']));

        $admin->givePermissionTo(Permission::create(['name' => 'users.index']));
        $admin->givePermissionTo(Permission::create(['name' => 'users.update']));
        $admin->givePermissionTo(Permission::create(['name' => 'users.destroy']));

        $admin->givePermissionTo(Permission::create(['name' => 'change user role assignments']));
        $admin->givePermissionTo(Permission::create(['name' => 'change role permission assignments']));
        $admin->givePermissionTo(Permission::create(['name' => 'change user customer assignments']));

        $admin->givePermissionTo(Permission::create(['name' => 'service-providers.create']));
        $admin->givePermissionTo(Permission::create(['name' => 'service-providers.update']));
        $admin->givePermissionTo(Permission::create(['name' => 'service-providers.destroy']));
    }
}
