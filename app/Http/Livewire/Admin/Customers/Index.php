<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Customer;
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
            'editing.company_name' => 'required',
            'editing.fully_qualified_name' => 'required',
            'editing.display_name' => 'required',
            'editing.first_name' => 'required',
            'editing.last_name' => 'required',
            'editing.phone' => 'required',
            'editing.email' => 'required',
            'editing.active' => 'required',
            'editing.sync' => 'required'
        ];
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
        $this->editing = $customer;
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
