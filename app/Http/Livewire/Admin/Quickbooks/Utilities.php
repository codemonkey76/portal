<?php

namespace App\Http\Livewire\Admin\Quickbooks;

use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class Utilities extends Component
{
    public $output = '';

    protected $listeners = ['echo:log,LogMessageReceived' => 'newLogMessage'];

    public function quickbooksSetup()
    {
        Artisan::call('qb:setup');

        $this->output = Artisan::output();
    }

    public function quickbooksCleanup()
    {
        Artisan::call('qb:cleanup');

        $this->output = Artisan::output();
    }

    public function newLogMessage()
    {
        $this->notify('New Message Received');
    }
    public function render()
    {
        return view('livewire.admin.quickbooks.utilities');
    }
}
