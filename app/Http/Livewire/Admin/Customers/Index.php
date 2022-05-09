<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Http\Livewire\Traits\WithAuthorizationMessage;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Livewire\Component;

class Index extends Component
{
    use WithPerPagePagination, WithSearch, WithSorting, WithAuthorizationMessage;

    public $perPageVariable = "customersPerPage";

    public bool $showEditModal = false;
    public bool $showDeleteModal = false;

    public Customer $editing;
    public $deleting = null;

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
        if (auth()->user()->cannot('customers.create'))
            return $this->denied();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankCustomer();
        $this->showEditModal = true;
    }

    public function edit(Customer $customer)
    {
        if (auth()->user()->cannot('customers.update'))
            return $this->denied();


        if ($this->editing->isNot($customer)) $this->editing = $customer;
        $this->showEditModal = true;
    }

    public function save()
    {
        $isEditing = !!$this->editing->getKey();

        if ($isEditing && auth()->user()->cannot('customers.update')) return $this->denied();
        if (!$isEditing && auth()->user()->cannot('customers.create')) return $this->denied();

        $this->validate();
        $this->editing->save();
        $this->notify("Customer saved successfully!");
        $this->showEditModal = false;
    }

    public function confirmDelete(Customer $customer)
    {
        if ($this->checkIfCanDelete($customer))
        {
            $this->deleting = $customer;
            $this->showDeleteModal = true;
        }
    }

    public function checkIfCanDelete(Customer $customer)
    {
        if (auth()->user()->cannot('customers.destroy')) return $this->denied();

        if ($customer->invoices()->count() + $customer->payments()->count() > 0) return $this->denied("Cannot delete customer that has transactions");

        if ($customer->service_agreements()->count() > 0) return $this->denied("Cannot delete customer that has service agreements");

        return true;
    }

    public function delete()
    {
        if (!$this->deleting) return;
        if (!$this->checkIfCanDelete($this->deleting)) return;

        if ($this->editing->is($this->deleting)) $this->editing = $this->makeBlankCustomer();

        $this->deleting->delete();
        $this->notify("Customer has been deleted successfully!");
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
