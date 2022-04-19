<?php

namespace App\Http\Livewire\Admin\Permissions;

use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithSorting, WithPerPagePagination;

    protected $perPageVariable = 'rolesPerPage';

    public $showDeleteDeniedModal = false;
    public $showDeleteConfirmation = false;
    public $showCreateModal = false;
    public $showEditModal = false;
    public $creating;
    public $deleting;
    public $editing;
    public $permissionsToAdd = [];
    public $permissionsToRemove = [];
    public $usersToAdd = [];
    public $usersToRemove = [];

    protected $rules = [
        'creating.name' => 'required|unique:roles,name'
    ];

    public function confirmDelete(Role $role)
    {
        if ($role->users->count()) {
            $this->showDeleteDeniedModal = true;
            return;
        }

        $this->deleting = $role;
        $this->showDeleteConfirmation = true;
    }

    public function edit(Role $role)
    {
        if (auth()->user()->can('edit roles')) {
            $this->editing = $role;
            $this->forgetComputed('availablePermissions');
            $this->showEditModal = true;
        }
    }

    public function getAvailablePermissionsProperty()
    {
        if (!$this->editing) return Permission::all();

        return Permission::whereNotIn('name', $this->editing->permissions->pluck('name'))->get();
    }

    public function addPermissionsToRole()
    {
        $this->editing->givePermissionTo($this->permissionsToAdd);
        $this->permissionsToAdd = [];
        $this->emit('permissionChanged');
    }

    public function removePermissionsFromRole()
    {
        $this->editing->revokePermissionsTo($this->permissionsToRemove);
        $this->permissionsToRemove = [];
        $this->emit('permissionChanged');
    }

    public function getAvailableUsersProperty()
    {
        if (!$this->editing) return User::all();

        return User::whereNotIn('id', $this->editing->users->pluck('id'))->get();
    }

    public function addUsersToRole()
    {
        collect($this->usersToAdd)->each(fn($userId) => User::find($userId)->assignRole($this->editing));
        $this->usersToAdd = [];
        $this->emit('usersChanged');
    }

    public function removeUsersFromRole()
    {
        collect($this->usersToRemove)->each(fn($userId) => User::find($userId)->removeRole($this->editing));
        $this->usersToRemove = [];
        $this->emit('usersChanged');
    }
    public function delete()
    {
        if (auth()->user()->can('delete roles')) {
            $this->deleting->delete();
            $this->showDeleteConfirmation = false;
            $this->notify("Role deleted successfully!");
        }
    }

    public function create()
    {
        if (auth()->user()->can('create roles')) {
            $this->creating = Role::make();
            $this->showCreateModal = true;
        }
    }

    public function save()
    {
        if (auth()->user()->can('create roles')) {
            $this->validate();
            $this->creating->save();
            $this->showCreateModal = false;
            $this->notify("Role created successfully!");
        }
    }

    public function getRowsQueryProperty()
    {
        $query = Role::query()
            ->withCount(['permissions', 'users']);

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function render()
    {

        return view('livewire.admin.permissions.index', ['roles' => $this->rows]);
    }
}

