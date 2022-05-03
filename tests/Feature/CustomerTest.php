<?php

namespace Tests\Feature;

use App\Http\Livewire\Admin\Customers\Index;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    protected function shouldSeed() : bool
    {
        return true;
    }

    protected function asAdmin()
    {
        $this->actingAs(User::whereName('Admin User')->first());
    }

    protected function asRegular()
    {
        $this->actingAs(User::whereName('Regular User')->first());
    }

    public function test_admin_can_see_customers()
    {
        $this->asAdmin();

        $this->get(route('customers.index'))->assertSeeLivewire(Index::class);
    }
    public function test_admin_can_create_customer()
    {
        $this->asAdmin();

        Livewire::test(Index::class)
                ->assertSee('CreateCustomerButton')
                ->call('create')
                ->assertSet('showEditModal', true);
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

        $this->assertTrue($customer->refresh()->first_name === 'bar');
    }

    public function test_admin_can_delete_customer()
    {
        $this->asAdmin();

        $customer = Customer::factory()->create();
        Livewire::test(Index::class)
                ->assertSee('DeleteCustomerButton')
                ->call('delete', $customer->id);

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

    public function admin_can_search_for_customer()
    {

    }
}
