<?php

namespace App\Http\Livewire\Admin\Quickbooks;

use App\Jobs\SetupQuickbooks;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;
use Log;

class Utilities extends Component
{
    public $output = '';
    public $userId;
    public $setupInProgress = false;

    protected function getListeners()
    {
        return [
            "echo-private:log.{$this->userId},LogMessageReceived" => 'newLogMessage',
            "echo-private:log.{$this->userId},QuickbooksSetupComplete" => 'setupComplete'
        ];
    }

    public function mount()
    {
        $this->userId = auth()->id();
    }

    public function setupComplete()
    {
        $this->setupInProgress = false;
        $this->output .= "Done." . PHP_EOL;
    }

    public function quickbooksSetup()
    {
        $this->setupInProgress = true;
        $this->output = "Dispatching QuickbooksSetup Job, please wait..." . PHP_EOL;
        SetupQuickbooks::dispatch(auth()->user());
    }

    public function quickbooksCleanup()
    {
        Artisan::call('qb:cleanup');

        $this->output = Artisan::output();
    }

    public function newLogMessage($e)
    {
        $this->output  .= $e['message'] . PHP_EOL;
    }

    public function render()
    {
        return view('livewire.admin.quickbooks.utilities');
    }
}
