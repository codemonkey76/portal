<?php

namespace App\Http\Livewire\Admin\ServiceAgreements;

use App\Http\Livewire\Traits\WithAuthorizationMessage;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Customer;
use App\Models\ServiceAgreement;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Livewire\Component;

class Index extends Component
{
    use WithPerPagePagination, WithSorting, WithSearch, WithAuthorizationMessage;

    protected string $perPageVariable="agreementsPerPage";

    public bool $showActivateModal = false;
    public $activating;
    public $activationDate;

    public $rules = [
        'activating.start' => 'required|date',
    ];

    public function updatedActivationDate()
    {
        $this->activating->start  = $this->activationDate;
    }

    public function getColumnList(): array
    {
        $agreementsTable = (new ServiceAgreement)->getTable();
        $agreementColumns = Schema::getColumnListing($agreementsTable);
        $col1 = collect($agreementColumns)->map(fn($column) => "$agreementsTable.$column as $column");

        $customersTable = (new Customer)->getTable();
        $customerColumns = Schema::getColumnListing($customersTable);
        $col2 = collect($customerColumns)->reject(fn($column) => $column === 'id' || $column === 'created_at' || $column === 'updated_at')->map(fn($column) => "$customersTable.$column as $column");

        return $col1->merge($col2)->toArray();
    }

    public function getRowsQueryProperty()
    {

        $query = ServiceAgreement::query()
                    ->join('customers', 'customer_id', '=', 'customers.id')
                    ->select($this->getColumnList())
                    ->search($this->search);

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function create()
    {
        if (Gate::denies('create', ServiceAgreement::class)) return $this->denied();

        return redirect()->route('service-agreements.create');
    }

    public function edit(ServiceAgreement $agreement)
    {
        if (Gate::denies('update', $agreement)) return $this->denied();

        return redirect()->route('service-agreements.edit', $agreement->id);
    }

    public function confirmActivate(ServiceAgreement $agreement)
    {
        if (Gate::denies('activate', $agreement)) return $this->denied();

        $this->activating = $agreement;

        $this->showActivateModal = true;
    }

    public function activate()
    {
        if (Gate::denies('activate', ServiceAgreement::find($this->activating->getKey()))) return $this->denied();

        $this->validate();
        $this->activating->save();

        $this->showActivateModal = false;
    }

    public function render()
    {
        return view('livewire.admin.service-agreements.index', ['agreements' => $this->rows]);
    }
}
