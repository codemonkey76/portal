<?php

namespace Tests\Feature;

use App\Http\Livewire\Admin\Accounts\Index;
use App\Models\Account;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Traits\RolesAndPermissions;

class AccountTest extends TestCase
{
    use RefreshDatabase, RolesAndPermissions;

    protected function shouldSeed() : bool
    {
        return true;
    }

    public function test_regular_user_cannot_see_accounts()
    {
        $this->asRegular();

        $this->get(route('accounts.index'))
             ->assertDontSeeLivewire(Index::class)
             ->assertStatus(403);
    }

    public function test_admin_can_see_accounts()
    {
        $this->asAdmin();

        $this->get(route('accounts.index'))->assertSeeLivewire(Index::class);
    }

    public function test_admin_can_create_account()
    {
        $this->asAdmin();

        Livewire::test(Index::class)
                ->assertSee('CreateAccountButton')
                ->call('create')
                ->assertSet('showEditModal', true)
                ->set('editing.name', 'foo')
                ->call('save');

        $this->assertTrue(Account::whereName('foo')->count() === 1);
    }

    public function test_admin_can_edit_account()
    {
        $this->asAdmin();

        $account = Account::factory()->create(['name' => 'foo']);

        Livewire::test(Index::class)
                ->assertSee('EditAccountButton')
                ->call('edit', $account->id)
                ->assertSet('showEditModal', true)
                ->set('editing.name', 'bar')
                ->call('save');

        $this->assertTrue($account->refresh()->name === 'bar');
    }

    public function test_admin_can_delete_account()
    {
        $this->asAdmin();

        $account = Account::factory()->create();

        Livewire::test(Index::class)
                ->assertSee('DeleteAccountButton')
                ->call('confirmDelete', $account->id)
                ->call('delete');

        $this->assertNull(Account::first());

    }

    public function test_admin_can_search_for_account()
    {
        $this->asAdmin();

        Account::factory()->create(['name' => 'foo', 'account_type' => 'foo type']);

        Livewire::test(Index::class)
                ->assertSee('AccountSearchButton')
                ->set('search', 'foo')
                ->assertSee('foo type')
                ->set('search', 'bar')
                ->assertDontSee('foo type');
    }

}
