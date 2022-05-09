<?php

namespace App\Http\Livewire\Admin\Accounts;

use App\Http\Livewire\Traits\WithEditsModels;
use App\Models\Account;
use Livewire\Component;

class Index extends Component
{
    use WithEditsModels;

    private string $destroyPermission = 'accounts.destroy';
    private string $createPermission = 'accounts.create';
    private string $updatePermission = 'accounts.update';
    private string $modelName = Account::class;

    public Account $editing;

    public function makeBlankModel()
    {
        return Account::create();
    }

    public function mount()
    {
        $this->editing = $this->makeBlankModel();
    }

    public function render()
    {
        return view('livewire.admin.accounts.index');
    }
}
