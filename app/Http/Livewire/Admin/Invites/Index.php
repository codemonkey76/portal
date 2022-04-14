<?php

namespace App\Http\Livewire\Admin\Invites;

use App\Http\Livewire\Traits\WithCachedRows;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Customer;
use App\Models\Invite;
use Livewire\Component;

class Index extends Component
{
    use WithPerPagePagination, WithSorting, WithSearch;

    public $showCreateModal = false;
    public $customers;
    public Invite $editing;
    protected $queryString = ['sorts'];
    protected $perPageVariable = "invitesPerPage";


    protected $rules = [
            'editing.name' => 'required',
            'editing.email' => 'required|email|unique:invites,email',
            'editing.customer_id' => 'required|exists:customers,id'
        ];
    public function create()
    {
        $this->editing = $this->makeBlankInvitation();
        $this->showCreateModal = true;
    }

    protected function makeBlankInvitation()
    {
        return Invite::make();
    }

    public function save()
    {
        $this->validate();
        $this->editing->save();
        $this->notify("Invitation has been queued and will be sent shortly!");
        $this->showCreateModal = false;
    }
    public function getRowsQueryProperty()
    {
        $query = Invite::query()
            ->with('customer')
            ->search($this->search);

        return $this->applySorting($query);
    }

    public function delete(Invite $invite)
    {
        $invite->delete();
        $this->notify("Invitation deleted successfully!");

    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function render()
    {
        return view('livewire.admin.invites.index', ['invites' => $this->rows]);
    }
}
