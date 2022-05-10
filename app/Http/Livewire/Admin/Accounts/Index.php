<?php

namespace App\Http\Livewire\Admin\Accounts;

use App\Http\Livewire\Traits\WithEditsModels;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Account;
use App\Models\AccountSubType;
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

    public $types = [];
    public $sub_types = [];
    public $account_type;
    public $account_sub_type;
    public $default_subtype;
    public $classification;

    protected function rules()
    {
        return [
            'account_type' => 'required|exists:account_types,id',
            'account_sub_type' => 'required|in:' . implode(',', AccountSubType::where('account_type_id', $this->account_type)->pluck('id')->toArray()),
            'classification' => '',
            'editing.name' => 'required',
            'editing.description' => '',
            'editing.active' => '',
            'editing.sync' => ''
        ];
    }

    public function beforeEdit()
    {
        $this->account_type = AccountType::whereName($this->editing->account_type)->first()->id;
        $this->updatedAccountType();
        $this->account_sub_type = AccountSubType::whereName($this->editing->account_sub_type)->first()->id;
    }


    public function updatedAccountType()
    {
        $accountType = AccountType::find($this->account_type);
        $this->account_sub_type = $accountType->default_account_subtype_id;
        $this->sub_types = $accountType->accountSubtypes;
        $this->classification = $accountType->accountClassification->name;
        $this->editing->account_type = $accountType->name;
    }

    public function makeBlankModel()
    {
        return Account::make();
    }

    public function mount()
    {
        $this->editing = $this->makeBlankModel();
        $this->types = AccountType::orderBy('name')->get();
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
