<?php

namespace App\Policies;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransactionPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Transaction $transaction): bool
    {
        return $user->can('transactions.update');
    }

    public function send(User $user, Transaction $transaction): bool
    {
        return $transaction->isInvoice() && $user->can('transactions.send');
    }

    public function void(User $user, Transaction $transaction): bool
    {
        return $transaction->isInvoice() && $user->can('transactions.void');
    }

    public function show(User $user, Transaction $transaction): bool
    {
        return $transaction->isInvoice() && $user->can('transactions.show');
    }

    public function copy(User $user, Transaction $transaction): bool
    {
        return $transaction->isInvoice() && $user->can('transactions.copy');
    }

    public function delete(User $user, Transaction $transaction): bool
    {
        return $user->can('transactions.delete');
    }

    public function edit(User $user, Transaction $transaction): bool
    {
        return $user->can('transactions.update');
    }
}
