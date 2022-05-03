<?php

namespace Tests\Feature;

use App\Http\Livewire\Admin\Menus\Admin as AdminIndex;
use App\Http\Livewire\Admin\Menus\Main as MainIndex;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class MenuTest extends TestCase
{
    use RefreshDatabase;

    protected function shouldSeed() : bool
    {
        return true;
    }

    public function test_regular_user_cannot_see_menus_index()
    {
        $this->asRegular();

        $this->get(route('menus.index'))
             ->assertDontSeeLivewire(AdminIndex::class)
             ->assertDontSeeLivewire(MainIndex::class)
             ->assertStatus(403);
    }

    public function test_admin_user_can_see_menus_index()
    {
        $this->asSuper();

        $this->get(route('menus.index'))
             ->assertSeeLivewire(AdminIndex::class)
             ->assertSeeLivewire(MainIndex::class);
    }


    protected function asRegular()
    {
        $this->actingAs(User::whereName('Regular User')->first());
    }

    protected function asSuper()
    {
        $this->actingAs(User::whereName('Super User')->first());
    }

    public function test_admin_can_create_admin_menu()
    {
        $this->asSuper();

        $menu_id = Menu::query()->admin()->first()->id;

        Livewire::test(AdminIndex::class)
            ->assertSee('CreateAdminMenuButton')
            ->call('create')
            ->assertSet('showEditModal', true)
            ->set('editing.label', 'foo')
            ->set('editing.menu_id', $menu_id)
            ->set('editing.route', 'home')
            ->set('editing.icon', 'foo')
            ->set('editing.permission_required', 'menus.create')
            ->call('save');

        $this->assertTrue(MenuItem::whereLabel('foo')->count() === 1);
    }

    public function test_admin_can_create_main_menu()
    {
        $this->asSuper();

        $menu_id = Menu::query()->main()->first()->id;

        Livewire::test(MainIndex::class)
                ->assertSee('CreateMainMenuButton')
                ->call('create')
                ->assertSet('showEditModal', true)
                ->set('editing.label', 'foo')
                ->set('editing.menu_id', $menu_id)
                ->set('editing.route', 'home')
                ->set('editing.icon', 'foo')
                ->set('editing.permission_required', 'menus.create')
                ->call('save');

        $this->assertTrue(MenuItem::whereLabel('foo')->count() === 1);
    }

    public function test_admin_can_reorder_admin_menu()
    {
        $menu = Menu::query()->admin()->with('items')->first();
        $query = $menu->items()->orderBy('order');
        $first = $query->first();
        $second = $query->skip(1)->first();

        Livewire::test(AdminIndex::class)
            ->call('increment', $first->id);

        $this->assertTrue($first->fresh()->order === 2);
        $this->assertTrue($second->fresh()->order === 1);
    }

    public function test_admin_can_reorder_main_menu()
    {
        $menu = Menu::query()->main()->with('items')->first();
        $query = $menu->items()->orderBy('order');
        $first = $query->first();
        $second = $query->skip(1)->first();

        Livewire::test(MainIndex::class)
                ->call('increment', $first->id);

        $this->assertTrue($first->fresh()->order === 2);
        $this->assertTrue($second->fresh()->order === 1);
    }

    public function test_admin_can_edit_admin_menu()
    {
        $this->asSuper();

        $first_menu = Menu::query()->admin()->first()->items()->first();

        Livewire::test(AdminIndex::class)
                ->assertSee('EditAdminMenuButton')
                ->call('edit', $first_menu->id)
                ->set('editing.menu_id', $first_menu->menu_id)
                ->set('editing.label', 'foo')
                ->set('editing.icon', 'foo')
                ->set('editing.route', 'home')
                ->call('save');

        $this->assertTrue($first_menu->fresh()->label === 'foo');
    }

    public function test_admin_can_edit_main_menu()
    {
        $this->asSuper();

        $first_menu = Menu::query()->main()->first()->items()->first();

        Livewire::test(MainIndex::class)
                ->assertSee('EditMainMenuButton')
                ->call('edit', $first_menu->id)
                ->set('editing.menu_id', $first_menu->menu_id)
                ->set('editing.label', 'foo')
                ->set('editing.icon', 'foo')
                ->set('editing.route', 'home')
                ->set('editing.permission_required', null)
                ->call('save');

        $this->assertTrue($first_menu->fresh()->label === 'foo');
    }

    public function test_admin_can_delete_admin_menu()
    {
        $this->asSuper();

        $first_menu = Menu::query()->admin()->first()->items()->first();

        Livewire::test(AdminIndex::class)
            ->assertSee('DeleteAdminMenuButton')
            ->call('delete', $first_menu->id);

        $this->assertTrue(MenuItem::find($first_menu->id) === null);
    }

    public function test_admin_can_delete_main_menu()
    {
        $this->asSuper();

        $first_menu = Menu::query()->main()->first()->items()->first();

        Livewire::test(MainIndex::class)
                ->assertSee('DeleteMainMenuButton')
                ->call('delete', $first_menu->id);

        $this->assertTrue(MenuItem::find($first_menu->id) === null);
    }
}
