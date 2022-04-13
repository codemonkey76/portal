<?php

namespace App\Http\Livewire\Traits;

use Livewire\WithPagination;

trait WithPerPagePagination
{
    use WithPagination;

    public $perPageOptions = [
        10 => '10', 25 => '25', 50 => '50', 100 => '100'
    ];

    public $perPage = 10;

    public function mountWithPerPagePagination()
    {
        $this->perPage = session()->get($this->perPageVariable, $this->perPage);
    }

public function updatingPerPage()
{
    $this->validateOnly('perPage', [
        'perPage' => 'required|number'
    ]);
}

    public function updatedPerPage($value)
    {
        session()->put($this->perPageVariable, $value);
    }

    public function applyPagination($query)
    {
        return $query->paginate($this->perPage);
    }

}