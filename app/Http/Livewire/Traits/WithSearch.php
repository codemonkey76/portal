<?php
namespace App\Http\Livewire\Traits;

trait WithSearch
{
    public $search = '';

    public function updatedSearch()
    {
        $this->resetPage();
    }
}