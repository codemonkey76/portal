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
        return $user->can('service-agreements.update') && !$serviceAgreement->signed_at;
    }

    public function activate(User $user, ServiceAgreement $serviceAgreement)
    {
        return $user->can('service-agreements.update') && ($serviceAgreement->status === 'waiting');
    }

    public function delete(User $user, ServiceAgreement $serviceAgreement)
    {
        return $user->can('service-agreements.destroy');
    }
}
