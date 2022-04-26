<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

class Index extends Component
{
    use WithPerPagePagination, WithSearch, WithSorting;

    public $perPageVariable = "customersPerPage";

    public bool $showEditModal = false;
    public bool $showDeleteModal = false;

    public Customer $editing;

    public function rules()
    {
        return [
            'editing.company_name' => 'required|string|max:255',
            'editing.fully_qualified_name' => 'required|string|max:255',
            'editing.display_name' => 'required|string|max:255',
            'editing.first_name' => '',
            'editing.last_name' => '',
            'editing.phone' => 'required|string|max:255',
            'editing.email' => 'required|email|max:255',
            'editing.active' => 'required|boolean',
            'editing.sync' => 'required|boolean'
        ];
    }

    public function show(Customer $customer)
    {
        return redirect()->route('customers.show', $customer->id);
    }
    public function create()
    {
        if (auth()->user()->can('create customers')) {
            if ($this->editing->getKey()) $this->editing = $this->makeBlankCustomer();

            $this->showEditModal = true;
        }
    }

    public function edit(Customer $customer)
    {
        if (auth()->user()->can('edit customers')) {
            if ($this->editing->isNot($customer)) $this->editing = $customer;

            $this->showEditModal = true;
        }
    }

    public function save()
    {
        $isEditing = !!$this->editing->getKey();

        if ($isEditing && auth()->user()->cannot('edit customers')) return;
        if (!$isEditing && auth()->user()->cannot('create customers')) return;

        $this->validate();
        $this->editing->save();
        $this->notify("Customer saved successfully!");
        $this->showEditModal = false;
    }

    public function confirmDelete(Customer $customer)
    {


    }

    public function delete()
    {

    }

    public function getRowsQueryProperty()
    {
        $query = Customer::query()
            ->search($this->search);

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function makeBlankCustomer()
    {
        return Customer::make([
            'active' => true,
            'sync' => false
        ]);
    }

    public function mount()
    {
        $this->editing = $this->makeBlankCustomer();
    }

    public function render()
    {
        return view('livewire.admin.customers.index', ['customers' => $this->rows]);
    }
}
