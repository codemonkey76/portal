<?php

namespace App\Http\Livewire\Traits;

trait WithAuthorizationMessage
{
    public function denied($message = "You don't have the required permission"): bool
    {
        $this->notify($message);
        return false;
    }
}
