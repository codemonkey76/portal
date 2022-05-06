<?php

namespace Tests\Feature;

use App\Http\Livewire\Admin\Products\Index;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Traits\RolesAndPermissions;

class ProductTest extends TestCase
{
    use RefreshDatabase, RolesAndPermissions;

    protected function shouldSeed() : bool
    {
        return true;
    }

    public function test_regular_user_cannot_see_products()
    {
        $this->asRegular();

        $this->get(route('products.index'))
             ->assertDontSeeLivewire(Index::class)
             ->assertStatus(403);
    }

    public function test_admin_can_see_products()
    {
        $this->asAdmin();

        $this->get(route('products.index'))->assertSeeLivewire(Index::class);
    }

    public function test_admin_can_create_product()
    {
        $this->asAdmin();

        Livewire::test(Index::class)
                ->assertSee('CreateProductButton')
                ->call('create')
                ->assertSet('showEditModal', true)
                ->set('editing.name', 'foo')
                ->call('save');

        $this->assertTrue(Product::whereName('foo')->count() === 1);
    }

    public function test_admin_can_edit_product()
    {
        $this->asAdmin();

        $product = Product::factory()->create(['name' => 'foo']);

        Livewire::test(Index::class)
                ->assertSee('EditProductButton')
                ->call('edit', $product->id)
                ->assertSet('showEditModal', true)
                ->set('editing.name', 'bar')
                ->call('save');

        $this->assertTrue($product->refresh()->name === 'bar');
    }

    public function test_admin_can_delete_product()
    {
        $this->asAdmin();

        $product = Product::factory()->create();

        Livewire::test(Index::class)
            ->assertSee('DeleteProductButton')
            ->call('confirmDelete', $product->id)
            ->call('delete');

        $this->assertNull(Product::first());

    }

    public function test_admin_can_search_for_product()
    {
        $this->asAdmin();

        Product::factory()->create(['name' => 'foo', 'description' => 'foo description']);

        Livewire::test(Index::class)
                ->assertSee('ProductSearchButton')
                ->set('search', 'foo')
                ->assertSee('foo description')
                ->set('search', 'bar')
                ->assertDontSee('foo description');
    }
}
