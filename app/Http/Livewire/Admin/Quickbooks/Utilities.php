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

    protected function getListeners()
    {
        return [
            "echo-private:log.{$this->userId},LogMessageReceived" => 'newLogMessage'
        ];
    }

    public function mount()
    {
        $this->userId = auth()->id();
    }

    public function quickbooksSetup()
    {
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
