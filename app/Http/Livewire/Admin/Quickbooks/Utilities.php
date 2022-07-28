<?php

namespace App\Http\Livewire\Admin\Quickbooks;

use App\Jobs\CleanupQuickbooks;
use App\Jobs\SetupQuickbooks;
use App\Models\GlobalSetting;
use Illuminate\Support\Facades\Artisan;
use Livewire\Component;
use Log;

class Utilities extends Component
{
    public $messages;
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
        $this->taskInProgress = GlobalSetting::whereKey('global_task_in_progress')->first()->value === 'true';
        $this->getLogMessages();
    }

    public function getLogMessages()
    {
        $this->messages = auth()->user()->logMessages()->latest()->take(100)->get();
    }


    public function taskComplete()
    {
        $this->taskInProgress = false;
    }

    public function quickbooksSetup()
    {
        auth()->user()->logMessage("Dispatching QuickbooksSetup Job, please wait..." . PHP_EOL);
        SetupQuickbooks::dispatch(auth()->user())->onQueue('default_long');
    }

    public function quickbooksCleanup()
    {
        auth()->user()->logMessage("Dispatching QuickbooksCleanup Job, please wait..." . PHP_EOL);
        CleanupQuickbooks::dispatch(auth()->user())->onQueue('default_long');
    }

    public function newLogMessage()
    {
        $this->getLogMessages();
    }

    public function render()
    {
        return view('livewire.admin.quickbooks.utilities');
    }
}
