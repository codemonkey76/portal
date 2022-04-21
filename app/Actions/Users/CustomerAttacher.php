<?php

namespace App\Actions\Users;

use App\Models\User;

class CustomerAttacher
{

    public function attach(User $user, array $customerIds): void
    {
        // Attach customers
        $user->customers()->attach($customerIds);

        // Set primary customer
        $user->primary_customer_id ??= intval($customerIds[0]);
        $user->save();
    }

    public function detach(User $user, array $customerIds): void
    {
        // Detach customers
        $user->customers()->detach($customerIds);

        // Clear primary customer
        if (!$user->fresh()->customers()->count()) $user->update(['primary_customer_id' => null]);
    }

}
