<?php

namespace App\Http\Livewire\Admin\Quickbooks;

use App\Jobs\CleanupQuickbooks;
use App\Jobs\SetupQuickbooks;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;
use Log;

class Utilities extends Component
{
    public $output = '';
    public $userId;
    public $taskInProgress = false;

    protected function getListeners()
    {
        return [
            "echo-private:log.{$this->userId},LogMessageReceived" => 'newLogMessage',
            "echo-private:log.{$this->userId},TaskComplete" => 'taskComplete'
        ];
    }

    public function mount()
    {
        $this->userId = auth()->id();
    }

    public function taskComplete()
    {
        $this->taskInProgress = false;
        $this->output .= "Task complete." . PHP_EOL;
    }

    public function quickbooksSetup()
    {
        $this->taskInProgress = true;
        $this->output = "Dispatching QuickbooksSetup Job, please wait..." . PHP_EOL;
        SetupQuickbooks::dispatch(auth()->user())->onQueue('default_long');
    }

    public function quickbooksCleanup()
    {
        $this->taskInProgress = true;
        $this->output = "Dispatching QuickbooksCleanup Job, please wait..." . PHP_EOL;
        CleanupQuickbooks::dispatch(auth()->user())->onQueue('default_long');
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
