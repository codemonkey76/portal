<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Sidebar extends Component
{
    public $admin;

    public function mount()
    {
        //$this->admin = session()->get('preferAdminMenu', false);
    }

    public function updatedAdmin()
    {
        //session()->put('preferAdminMenu', $this->admin);
    }

    public function render()
    {
        return view('livewire.sidebar');
    }
}
