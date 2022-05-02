<?php

namespace App\Http\Livewire\Admin\ServiceAgreements;

use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\ServiceAgreement;
use Livewire\Component;

class Index extends Component
{
    use WithPerPagePagination, WithSorting, WithSearch;

    protected string $perPageVariable="agreementsPerPage";


    public function getRowsQueryProperty()
    {
        $query = ServiceAgreement::query()
                    ->join('customers', 'customer_id', '=', 'customers.id')
                    ->search($this->search);

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function create()
    {
        return redirect()->route('service-agreements.create');
    }

    public function edit(ServiceAgreement $agreement)
    {
        return redirect()->route('service-agreements.edit', $agreement->id);
    }

    public function render()
    {
        return view('livewire.admin.service-agreements.index', ['agreements' => $this->rows]);
    }
}
