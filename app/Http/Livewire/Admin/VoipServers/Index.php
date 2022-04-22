<?php

namespace App\Http\Livewire\Admin\VoipServers;

use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\VoipServer;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Index extends Component
{
    use WithPerPagePagination, WithSearch, WithSorting;

    public $perPageVariable = 'serversPerPage';


    public VoipServer $editing;
    public VoipServer $deleting;

    public bool $creating = false;
    public bool $showEditModal = false;
    public bool $showDeleteModal = false;
    public bool $credentialsChecked = false;
    public bool $credentialsValid = false;

    protected function rules()
    {
        return [
            'editing.name' => 'required',
            'editing.server_url' => 'required',
            'editing.api_user' => 'required',
            'editing.api_password' => 'required',
            'editing.active' => 'required|boolean',
            'credentialsValid' => ['required', 'boolean', Rule::in([true])]
        ];
    }

    protected $messages = [
        'credentialsValid.in' => 'You must test the credentials are valid, before saving'
    ];

    public function getRowsQueryProperty()
    {
        $query = VoipServer::query()
            ->search($this->search);

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function edit(VoipServer $voip_server)
    {
        if (auth()->user()->can('edit voip servers'))
        {
            if ($this->editing->isNot($voip_server))
            {
                $this->editing = $voip_server;
                $this->credentialsChecked = true;
                $this->credentialsValid = true;
                $this->resetErrorBag();
            }

            $this->showEditModal = true;
        }
    }

    public function updated($name, $value)
    {
        if (in_array($name, ['editing.api_user', 'editing.api_password', 'editing.server_url']))
        {
            $this->credentialsChecked = false;
            $this->credentialsValid = false;
        }

    }

    public function testConnection()
    {
        $this->credentialsChecked = true;
        $this->credentialsValid = true;
        $this->validateOnly('credentialsValid');
    }

    public function confirmDelete(VoipServer $voip_server)
    {
        if (auth()->user()->can('delete voip servers'))
        {
            $this->deleting = $voip_server;
            $this->showDeleteModal = true;
        }
    }

    public function delete()
    {
        if (auth()->user()->can('delete voip servers') && $this->deleting)
        {
            $this->deleting->delete();
            $this->notify('Deleted VOIP server succesfully!');
            $this->showDeleteModal = false;
            $this->resetPage();
        }
    }

    public function save()
    {
        $permission = $this->creating ? 'create voip servers' : 'edit voip servers';

        if (auth()->user()->can($permission))
        {
            $this->validate();
            $this->editing->save();
            $this->notify('VOIP Server saved successfully!');
            $this->showEditModal = false;
        }
    }

    public function create()
    {
        if (auth()->user()->can('create voip servers'))
        {
            if ($this->editing->getKey())
            {
                $this->editing = $this->makeBlankVoipServer();
                $this->resetErrorBag();
                $this->creating = true;
            }

            $this->showEditModal = true;
        }
    }

    public function makeBlankVoipServer()
    {
        return VoipServer::make(['active' => false]);
    }

    public function mount()
    {
        $this->editing = $this->makeBlankVoipServer();
    }
    public function render()
    {
        return view('livewire.admin.voip-servers.index', ['voip_servers' => $this->rows]);
    }
}
