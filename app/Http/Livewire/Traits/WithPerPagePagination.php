<?php

namespace App\Http\Livewire\Traits;

use Livewire\WithPagination;

trait WithPerPagePagination
{
    use WithPagination;

    public array $perPageOptions = [
        10 => '10', 25 => '25', 50 => '50', 100 => '100'
    ];

    public int $perPage = 10;

    public function mountWithPerPagePagination()
    {
        $this->perPage = intval(session()->get($this->perPageVariable, $this->perPage));
    }

public function updatingPerPage()
{
    $this->validateOnly('perPage', [
        'perPage' => 'required|numeric'
    ]);
}

    public function updatedPerPage($value)
    {
        session()->put($this->perPageVariable, $value);
        $this->resetPage();
    }

    public function applyPagination($query)
    {
        return $query->paginate($this->perPage);
    }

}
