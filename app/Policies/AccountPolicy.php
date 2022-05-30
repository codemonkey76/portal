<?php

namespace App\Policies;

use App\Models\Account;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AccountPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->can('accounts.create');
    }

    public function update(User $user, Account $account)
    {
        return $user->can('accounts.update');
    }

    public function delete(User $user, Account $account)
    {
        return $user->can('accounts.destroy');
    }

}
