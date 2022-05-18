<?php

namespace Tests\Feature;

use App\Http\Livewire\Admin\Items\Index;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Traits\RolesAndPermissions;

class ItemTest extends TestCase
{
    use RefreshDatabase, RolesAndPermissions;

    protected function shouldSeed() : bool
    {
        return true;
    }

    public function test_regular_user_cannot_see_products()
    {
        $this->asRegular();

        $this->get(route('items.index'))
             ->assertDontSeeLivewire(Index::class)
             ->assertStatus(403);
    }

    public function test_admin_can_see_items()
    {
        $this->asAdmin();

        $this->get(route('items.index'))->assertSeeLivewire(Index::class);
    }

    public function test_admin_can_create_product()
    {
        $this->asAdmin();

        Livewire::test(Index::class)
                ->assertSee('CreateItemButton')
                ->call('create')
                ->assertSet('showEditModal', true)
                ->set('editing.name', 'foo')
                ->call('save');

        $this->assertTrue(Item::whereName('foo')->count() === 1);
    }

    public function test_admin_can_edit_product()
    {
        $this->asAdmin();

        $product = Item::factory()->create(['name' => 'foo']);

        Livewire::test(Index::class)
                ->assertSee('EditItemButton')
                ->call('edit', $product->id)
                ->assertSet('showEditModal', true)
                ->set('editing.name', 'bar')
                ->call('save');

        $this->assertTrue($product->fresh()->name === 'bar');
    }

    public function test_admin_can_delete_product()
    {
        $this->asAdmin();

        $product = Item::factory()->create();

        Livewire::test(Index::class)
            ->assertSee('DeleteItemButton')
            ->call('confirmDelete', $product->id)
            ->call('delete');

        $this->assertNull(Item::first());

    }

    public function test_admin_can_search_for_product()
    {
        $this->asAdmin();

        Item::factory()->create(['name' => 'foo', 'description' => 'foo description']);

        Livewire::test(Index::class)
                ->assertSee('ItemSearchButton')
                ->set('search', 'foo')
                ->assertSee('foo description')
                ->set('search', 'bar')
                ->assertDontSee('foo description');
    }
}
