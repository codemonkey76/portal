<?php

namespace Tests\Feature;

use App\Http\Livewire\Admin\Permissions\Index;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;
use Tests\Traits\RolesAndPermissions;

class PermissionsTest extends TestCase
{
    use RefreshDatabase, RolesAndPermissions;

    protected function shouldSeed(): bool
    {
        return true;
    }

    public function test_regular_user_cannot_see_permissions()
    {
        $this->asRegular();

        $this->get(route('permissions.index'))
             ->assertDontSeeLivewire(Index::class)
             ->assertStatus(403);
    }

    public function test_admin_can_see_products()
    {
        $this->asSuper();

        $this->get(route('permissions.index'))
             ->assertSeeLivewire(Index::class)
             ->assertStatus(200);
    }

    public function test_admin_can_create_role()
    {
        $this->asSuper();

        Livewire::test(Index::class)
                ->assertSee('CreateRoleButton')
                ->call('create')
                ->assertSet('showCreateModal', true)
                ->set('creating.name', 'foo')
                ->call('save');

        $this->assertTrue(Role::whereName('foo')->count() === 1);
    }

    public function test_admin_can_add_users_to_role()
    {
        $this->asSuper();

        $role = Role::create(['name' => 'foo']);

        $user = User::factory()->create();

        $this->assertFalse($user->hasRole([$role->id]));
        Livewire::test(Index::class)
                ->assertSee('EditRoleButton')
                ->call('edit', $role->id)
                ->assertSet('showEditModal', true)
                ->set('usersToAdd', [$user->id])
                ->call('addUsersToRole');

        $this->assertTrue($user->fresh()->hasRole([$role->id]));
    }

    public function test_admin_can_remove_users_from_role()
    {
        $this->asSuper();

        $role = Role::create(['name' => 'foo']);

        $user = User::factory()->create();
        $user->assignRole('foo');

        $this->assertTrue($user->hasRole([$role->id]));
        Livewire::test(Index::class)
                ->assertSee('EditRoleButton')
                ->call('edit', $role->id)
                ->assertSet('showEditModal', true)
                ->set('usersToRemove', [$user->id])
                ->call('removeUsersFromRole');

        $this->assertFalse($user->fresh()->hasRole('foo'));
    }

    public function test_admin_can_add_permissions_to_role()
    {
        $this->asSuper();

        $role = Role::create(['name' => 'foo']);

        $permission = Permission::create(['name' => 'foo']);

        $this->assertFalse($role->hasDirectPermission($permission));
        Livewire::test(Index::class)
                ->assertSee('EditRoleButton')
                ->call('edit', $role->id)
                ->assertSet('showEditModal', true)
                ->set('permissionsToAdd', [$permission->id])
                ->call('addPermissionsToRole');

        $this->assertTrue($role->fresh()->hasDirectPermission('foo'));
    }

    public function test_admin_can_remove_permissions_from_role()
    {
        $this->asSuper();

        $role = Role::create(['name' => 'foo']);

        $user = User::factory()->create();
        $user->assignRole('foo');

        $this->assertTrue($user->hasRole([$role->id]));
        Livewire::test(Index::class)
                ->assertSee('EditRoleButton')
                ->call('edit', $role->id)
                ->assertSet('showEditModal', true)
                ->set('usersToRemove', [$user->id])
                ->call('removeUsersFromRole');

        $this->assertFalse($user->fresh()->hasRole('foo'));
    }
}
