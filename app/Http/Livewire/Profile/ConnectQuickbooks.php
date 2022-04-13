<?php

namespace App\Http\Livewire\Profile;

use Illuminate\Support\Facades\Http;
use Laravel\Jetstream\ConfirmsPasswords;
use Livewire\Component;
use Popplestones\Quickbooks\Services\QuickbooksClient;

class ConnectQuickbooks extends Component
{
    use ConfirmsPasswords;

    /**
     * Determine if quickbooks is connected for user.
     *
     * @return bool
     */
    public function getConnectedProperty()
    {
        return ! empty(auth()->user()->quickbooksToken);
    }

    /**
     * Connect Quickbooks for the user.
     *
     * @return void
     */
    public function connectQuickbooks(QuickbooksClient $quickbooks)
    {
        $this->ensurePasswordIsConfirmed();

        try {
            return redirect()->to($quickbooks->authorizationUri());
        }
        catch (\Exception $e)
        {
            $this->notify($e->getMessage());
        }
    }

    /**
     * Disconnect Quickbooks for the user.
     *
     * @return void
     */
    public function disconnectQuickbooks(QuickbooksClient $quickbooks)
    {
        $this->ensurePasswordIsConfirmed();
        $quickbooks->deleteToken();

        $this->forgetComputed('connected');
        $this->notify("Quickbooks has been disconnected from your account");
    }

    public function render()
    {
        return view('livewire.profile.connect-quickbooks');
    }
}
