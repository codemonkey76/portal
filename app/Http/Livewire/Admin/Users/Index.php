<?php

namespace App\Http\Livewire\Admin\Users;

use App\Actions\Users\CustomerAttacher;
use App\Http\Livewire\Traits\WithAuthorizationMessage;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Symfony\Component\HttpFoundation\StreamedResponse;

class Index extends Component
{
    use WithPerPagePagination, WithSearch, WithSorting, AuthorizesRequests, WithAuthorizationMessage;

    public bool $showDeleteModal = false;
    public bool $showEditModal = false;

    public array $customersToAssign = [];
    public array $customersToUnassign = [];
    public array $rolesToAdd = [];
    public array $rolesToRemove = [];
    public User $editing;
    public User $deleting;

    protected $listeners = ['refreshUsers' => '$refresh'];
    protected string $perPageVariable = "usersPerPage";


    public function rules()
    {
        $rules = [
            'editing.primary_customer_id' => [
                'exists:customers,id',
                Rule::in($this->editing->customers()->pluck('customers.id')->toArray())
            ],
            'editing.active' => 'required|boolean'
        ];

        if ($this->editing->customers()->count())
            $rules['editing.primary_customer_id'][] = 'required';
        else
        {
            $rules['editing.primary_customer_id'][] = 'nullable';
            $this->editing->primary_customer_id = null;
        }

        return $rules;
    }

    public function getAvailableCustomersProperty()
    {
        return $this->editing ? Customer::whereNotIn('id', $this->editing->customers->pluck('id'))->get() : Customer::all();
    }

    public function exportSelected(): StreamedResponse
    {
        return response()->streamDownload(function() {
            echo $this->selectedRowsQuery->toCsv();
        }, 'users.csv');
    }

    public function assignCustomerToUser(CustomerAttacher $attacher)
    {
        if (Gate::denies('assign', User::find($this->editing->getKey())))
            return $this->denied();

        $attacher->attach($this->editing, $this->customersToAssign);

        $this->editing->refresh();
        $this->customersToAssign = [];
        $this->emit('assignedCustomersChanged');

    }

    public function unassignCustomerFromUser(CustomerAttacher $attacher)
    {
        if (Gate::denies('assign', User::find($this->editing->getKey()))) return $this->denied();

        $attacher->detach($this->editing, $this->customersToUnassign);

        $this->editing->refresh();

        $this->customersToUnassign = [];

        $this->emit('assignedCustomersChanged');
    }

    public function addRolesToUser()
    {
        if (Gate::denies('assign', User::find($this->editing->getKey()))) return $this->denied();

        $this->editing->assignRole($this->rolesToAdd);

        $this->editing->refresh();

        $this->rolesToAdd = [];

        $this->emit('assignedRolesChanged');
    }

    public function removeRolesFromUser()
    {
        if (Gate::denies('assign', User::find($this->editing->getKey()))) return $this->denied();

        $rolesToKeep = $this->editing->roles()->whereNotIn('name', $this->rolesToRemove)->pluck('name');

        $this->editing->syncRoles($rolesToKeep);

        $this->editing->refresh();

        $this->rolesToRemove = [];

        $this->emit('assignedRolesChanged');
    }

    public function getAvailableRolesProperty() : mixed
    {
        return $this->editing ? Role::whereNotIn('name', $this->editing->roles->pluck('name'))->get() : Role::all();
    }

    public function edit(User $user)
    {
        if (Gate::denies('update', $user)) return $this->denied();

        $this->editing = $user;

        $this->showEditModal = true;
    }

    public function confirmDelete(User $user)
    {
        if (Gate::denies('delete', $user)) return $this->denied();

        $this->deleting = $user;

        $this->showDeleteModal = true;
    }

    public function delete()
    {
        if (Gate::denies('delete', User::find($this->deleting->getKey()))) return $this->denied();

        $this->deleting->delete();

        $this->notify("User deleted successfully!");

        $this->showDeleteModal = false;
    }

    public function save()
    {
        if (Gate::denies('update', User::find($this->editing->getKey()))) return $this->denied();

        $this->validate();

        $this->editing->save();

        $this->notify("User updated successfully!");

        $this->showEditModal = false;
    }

    public function getRowsQueryProperty()
    {
        $query = User::query()
            ->with(['roles', 'primaryCustomer', 'customers'])
            ->search($this->search);

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function mount()
    {
        $this->editing = User::make();
    }

    public function render()
    {
        return view('livewire.admin.users.index', ['users' => $this->rows]);
    }
}
