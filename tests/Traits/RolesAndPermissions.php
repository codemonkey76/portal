<?php

namespace Tests\Traits;

use App\Models\User;

trait RolesAndPermissions
{
    protected function asAdmin()
    {
        $this->actingAs(User::whereName('Admin User')->first());
    }

    protected function asRegular()
    {
        $this->actingAs(User::whereName('Regular User')->first());
    }

    protected function asSuper()
    {
        $this->actingAs(User::whereName('Super User')->first());
    }
}
