<?php

namespace App\Http\Livewire\Admin\Accounts;

use App\Http\Livewire\Traits\WithEditsModels;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Account;
use App\Models\AccountType;
use Livewire\Component;

class Index extends Component
{
    use WithEditsModels, WithPerPagePagination, WithSearch, WithSorting;

    public string $perPageVariable = "accountsPerPage";
    private string $modelName = Account::class;
    public Account $editing;
    public $deleting = null;

    public bool $showEditModal = false;
    public bool $showDeleteConfirmation = false;

    public $types;

    public function makeBlankModel()
    {
        return Account::make();
    }

    public function mount()
    {
        $this->editing = $this->makeBlankModel();

        $this->sortBy('qb_account_id');
    }

    public function getRowsQueryProperty()
    {
        $query = Account::query()
                    ->search($this->search);

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function render()
    {
        return view('livewire.admin.accounts.index',['accounts' => $this->rows]);
    }
}
