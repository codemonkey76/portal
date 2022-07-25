<?php

namespace App\Http\Livewire\Admin\Quickbooks;

use Illuminate\Support\Facades\Artisan;
use Livewire\Component;

class Utilities extends Component
{
    public $output = '';


    public function quickbooksSetup()
    {
        Artisan::call('qb:setup')->appendOutput;

        $this->output = Artisan::output();
    }

    public function quickbooksCleanup()
    {
        Artisan::call('qb:cleanup');

        $this->output = Artisan::output();
    }
    public function render()
    {
        return view('livewire.admin.quickbooks.utilities');
    }
}
