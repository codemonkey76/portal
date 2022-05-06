<?php

namespace Tests\Feature;

use App\Http\Livewire\Admin\Invites\Index;
use App\Models\Customer;
use App\Models\Invite;
use App\Models\User;
use App\Notifications\InviteUser;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;
use Tests\Traits\RolesAndPermissions;

class InvitationTest extends TestCase
{
    use RefreshDatabase, RolesAndPermissions;

    protected function shouldSeed() : bool
    {
        return true;
    }

    public function test_regular_user_cannot_see_invitations()
    {
        $this->asRegular();

        $this->get(route('invites.index'))->assertDontSeeLivewire(Index::class);
    }

    public function test_admin_user_can_see_invitations()
    {
        $this->asAdmin();

        $this->get(route('invites.index'))->assertSeeLivewire(Index::class);
    }

    public function test_admin_user_can_create_invitation()
    {
        $this->asAdmin();

        Livewire::test(Index::class)
                ->assertSee('CreateInviteButton')
                ->call('create')
                ->assertSet('showCreateModal', true);
    }

    public function test_admin_user_can_send_invitation()
    {
        Notification::fake();

        $this->asAdmin();

        $customer = Customer::factory()->create();

        Livewire::test(Index::class)
                ->call('create')
                ->assertSet('showCreateModal', true)
                ->set('editing.name', 'foo')
                ->set('editing.email', 'foo@example.com')
                ->set('editing.customer_id', $customer->id)
                ->call('save');

        $this->assertTrue(Invite::whereName('foo')->count() === 1);

        Notification::assertSentTo(Invite::first(), InviteUser::class);
    }

    public function test_admin_can_delete_invitation()
    {
        $this->asAdmin();
        $customer = Customer::factory()->create();
        $invite = Invite::factory()->create(['customer_id' => $customer->id]);

        Livewire::test(Index::class)
            ->assertSee('DeleteInviteButton')
            ->call('delete', $invite->id);

        $this->assertTrue(Invite::count() === 0);
    }

    public function test_regular_user_cannot_delete_invitation()
    {
        $this->asRegular();
        $customer = Customer::factory()->create();
        $invite = Invite::factory()->create(['customer_id' => $customer->id]);

        Livewire::test(Index::class)
                ->call('delete', $invite->id);

        $this->assertTrue(Invite::count() === 1);
    }
}
