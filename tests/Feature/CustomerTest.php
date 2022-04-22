<?php

namespace Tests\Feature;

use App\Models\User;
use Database\Seeders\DatabaseSeeder;

use Tests\MigrateFreshAndSeedOnce;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use MigrateFreshAndSeedOnce;

    public function test_admin_can_create_customer()
    {
        $this->actingAs(User::whereName('Admin User')->first());

        $this->get(route('customers.index'))->assertSeeLivewire('admin.customers.index');

    }
}
