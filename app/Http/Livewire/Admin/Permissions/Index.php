<?php

namespace App\Http\Livewire\Admin\Permissions;

use App\Http\Livewire\Traits\WithAuthorizationMessage;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    use WithSorting, WithPerPagePagination, WithAuthorizationMessage;

    protected string $perPageVariable = 'rolesPerPage';




    public bool $showDeleteDeniedModal = false;
    public bool $showDeleteConfirmation = false;
    public bool $showCreateModal = false;
    public bool $showEditModal = false;
    public Role $creating;
    public Role $deleting;
    public Role $editing;
    public array $permissionsToAdd = [];
    public array $permissionsToRemove = [];
    public array $usersToAdd = [];
    public array $usersToRemove = [];

    protected array $rules = [
        'creating.name' => 'required|unique:roles,name'
    ];

    public function confirmDelete(Role $role)
    {
        if (auth()->user()->cannot('roles.destroy'))
            return $this->denied();

        if ($role->users->count()) {
            $this->showDeleteDeniedModal = true;
            return;
        }

        $this->deleting = $role;
        $this->showDeleteConfirmation = true;
    }

    public function edit(Role $role)
    {
        if (auth()->user()->cannot('roles.update'))
            return $this->denied();

        $this->editing = $role;
        $this->forgetComputed('availablePermissions');
        $this->showEditModal = true;
    }

    public function getAvailablePermissionsProperty() : mixed
    {
        return $this->editing ? Permission::whereNotIn('name', $this->editing->permissions->pluck('name'))->get() : Permission::all();
    }

    public function addPermissionsToRole()
    {
        if (auth()->user()->cannot('change role permission assignments'))
            return $this->denied();

        $this->editing->givePermissionTo($this->permissionsToAdd);
        $this->permissionsToAdd = [];
        $this->emit('permissionChanged');
    }

    public function removePermissionsFromRole()
    {
        if (auth()->user()->cannot('change role permission assignments'))
            return $this->denied();

        $this->editing->revokePermissionTo($this->permissionsToRemove);
        $this->permissionsToRemove = [];
        $this->emit('permissionChanged');
    }

    public function getAvailableUsersProperty()
    {
        return User::whereNotIn('id', $this->editing->users->pluck('id'))->get();
    }

    public function addUsersToRole()
    {
        if (auth()->user()->cannot('change user role assignments'))
            return $this->denied();

        collect($this->usersToAdd)->each(fn($userId) => User::find($userId)->assignRole($this->editing));
        $this->editing->refresh();
        $this->usersToAdd = [];
        $this->emit('usersChanged');
    }

    public function removeUsersFromRole()
    {
        if (auth()->user()->cannot('change user role assignments'))
            return $this->denied();

        collect($this->usersToRemove)->each(fn($userId) => User::find($userId)->removeRole($this->editing));
        $this->editing->refresh();
        $this->usersToRemove = [];
        $this->emit('usersChanged');
    }

    public function delete()
    {
        if (auth()->user()->cannot('roles.destroy'))
            return $this->denied();

        $this->deleting->delete();
        $this->showDeleteConfirmation = false;
        $this->notify("Role deleted successfully!");
    }

    public function create()
    {
        if (auth()->user()->cannot('roles.create'))
            return $this->denied();

        $this->creating = Role::make();
        $this->showCreateModal = true;
    }

    public function save()
    {
        if (auth()->user()->cannot('roles.create'))
            $this->denied();

        $this->validate();
        $this->creating->save();
        $this->showCreateModal = false;
        $this->notify("Role created successfully!");
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

