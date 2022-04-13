<?php

namespace App\Http\Livewire\Admin\Users;

use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Livewire\Traits\WithBulkActions;
use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Models\User;
use App\Http\Livewire\Traits\WithSorting;
use Livewire\Component;

class Index extends Component
{
    use WithPerPagePagination, WithSorting, WithBulkActions, WithSearch, WithCachedRows;
    use PasswordValidationRules;
    public $showDeleteModal = false;
    public $showEditModal = false;
    public $showFilters = false;

    public User $editing;
    protected $queryString = ['sorts'];
    protected $listeners = ['refreshUsers' => '$refresh'];
    protected $perPageVariable = "usersPerPage";

    public function rules()
    {
        return [
            'editing.name' => 'required',
            'editing.email' => 'required|email|unique',
            'editing.password' => [$this->passwordRules(), 'confirmed'],
            'editing.password_confirmation' => 'required'
        ];
    }

    public function mount()
    {
        $this->editing = $this->makeBlankUser();

        info(json_encode($this->editing));
    }

    public function exportSelected()
    {
        return response()->streamDownload(function() {
            echo $this->selectedRowsQuery->toCsv();
        }, 'users.csv');
    }

    public function deleteSelected()
    {
        $deleteCount = $this->selectedRowsQuery->count();

        $this->selectedRowsQuery->delete();
        $this->showDeleteModal = false;
        $this->notify('You\'ve deleted ' . $deleteCount . ' users');
    }

    public function makeBlankUser()
    {
        return User::make();
    }

    public function create()
    {
        $this->useCachedRows();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankUser();

        $this->showEditModal = true;
    }

    public function edit(User $user)
    {
        $this->useCachedRows();

        if ($this->editing->isNot($user)) $this->editing = $user;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;
    }

    public function getRowsQueryProperty()
    {
        $query = User::query()
            ->with('roles')
            ->search($this->search);

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function render()
    {
        return view('livewire.admin.users.index', ['users' => $this->rows]);
    }
}
