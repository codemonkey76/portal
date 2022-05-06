<?php

namespace Tests\Feature;

use App\Http\Livewire\Admin\Customers\Index;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Traits\RolesAndPermissions;

class CustomerTest extends TestCase
{
    use RefreshDatabase, RolesAndPermissions;

    protected function shouldSeed() : bool
    {
        return true;
    }

    public function test_admin_can_see_customers()
    {
        $this->asAdmin();

        $this->get(route('customers.index'))->assertSeeLivewire(Index::class);
    }

    public function test_blank_customer_is_active_and_sync_disabled()
    {
        $this->asAdmin();
        Livewire::test(Index::class)
            ->assertSet('editing.active', true)
            ->assertSet('editing.sync', false);
    }

    public function test_admin_can_edit_customer()
    {
        $this->asAdmin();

        $customer = Customer::factory()->create(['company_name' => 'foo']);

        Livewire::test(Index::class)
                ->assertSee('EditCustomerButton')
                ->call('edit', $customer->id)
                ->assertSet('showEditModal', true)
                ->set('editing.company_name', 'bar')
                ->call('save');

        $this->assertTrue($customer->refresh()->company_name === 'bar');
    }

    public function test_admin_can_delete_customer()
    {
        $this->asAdmin();

        $customer = Customer::factory()->create();
        Livewire::test(Index::class)
                ->assertSee('DeleteCustomerButton')
                ->call('confirmDelete', $customer->id)
                ->assertSet('showDeleteModal', true)
                ->call('delete');

        $this->assertNull(Customer::find($customer->id));
    }

    public function test_regular_user_cannot_see_customers()
    {
        $this->asRegular();

        $this->get(route('customers.index'))
             ->assertDontSeeLivewire(Index::class)
             ->assertStatus(403);
    }

    public function test_admin_can_create_customers()
    {
        $this->asAdmin();

        Livewire::test(Index::class)
            ->assertSee('CreateCustomerButton')
            ->call('create')
            ->assertSet('showEditModal', true)
            ->set('editing.company_name', 'foo')
            ->set('editing.fully_qualified_name', 'foo')
            ->set('editing.display_name', 'foo')
            ->set('editing.phone', '123456789')
            ->set('editing.email', 'foo@example.com')
            ->set('editing.active', true)
            ->set('editing.sync', true)
            ->call('save');

        $this->assertTrue(Customer::whereCompanyName('foo')->count() === 1);
    }

    public function test_admin_can_search_for_customer()
    {
        $this->asAdmin();

        Customer::factory()->create(['company_name' => 'foo', 'email' => 'foo@example.com']);

        Livewire::test(Index::class)
            ->assertSee('CustomerSearchButton')
            ->set('search', 'foo')
            ->assertSee('foo@example.com')
            ->set('search', 'bar')
            ->assertDontSee('foo@example.com');
    }
}
