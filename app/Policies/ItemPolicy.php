<?php

namespace App\Policies;

use App\Models\Item;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ItemPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('items.index');
    }

    public function view(User $user, Item $item)
    {
        return $user->can('items.show');
    }

    public function create(User $user)
    {
        return $user->can('items.create');
    }

    public function update(User $user, Item $item)
    {
        return $user->can('items.update');
    }

    public function delete(User $user, Item $item)
    {
        return $user->can('items.destroy');
    }
}
