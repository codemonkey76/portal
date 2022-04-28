<?php

namespace App\Policies;

use App\Models\ServiceAgreement;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ServiceAgreementPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->can('service-agreements.index');
    }

    public function view(User $user, ServiceAgreement $serviceAgreement)
    {
        return $user->can('service-agreements.show');
    }

    public function create(User $user)
    {
        return $user->can('service-agreements.create');
    }

    public function update(User $user, ServiceAgreement $serviceAgreement)
    {
        return $user->can('service-agreements.update');
    }

    public function delete(User $user, ServiceAgreement $serviceAgreement)
    {
        return $user->can('service-agreements.destroy');
    }
}
