<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    public function create(User $loggedInUser)
    {
        return $loggedInUser->can('users.create');
    }

    public function update(User $loggedInUser, User $user)
    {
        return $loggedInUser->can('users.update');
    }

    public function delete(User $loggedInUser, User $user)
    {
        return $loggedInUser->can('users.destroy');
    }

    public function assign(User $loggedInUser)
    {
        return $loggedInUser->can('roles.assign');
    }
}
