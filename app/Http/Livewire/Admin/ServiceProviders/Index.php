<?php

namespace App\Http\Livewire\Admin\ServiceProviders;

use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\ServiceProvider;
use Livewire\Component;

class Index extends Component
{
    use WithSearch, WithSorting, WithPerPagePagination;

    protected $perPageVariable="providersPerPage";

    public $showEditModal = false;
    public $showDeleteModal = false;
    public ServiceProvider $editing;


    public function create()
    {
        if (auth()->user()->can('create service providers'))
        {
            if ($this->editing->getKey()) $this->editing = $this->makeBlankProvider();
            $this->showEditModal = true;
        }
    }

    public function save()
    {
        $isEditing = !!$this->editing->getKey();

        if ($isEditing && auth()->user()->cannot('edit service providers')) return;
        if (!$isEditing && auth()->user()->cannot('create service providers')) return;

        $this->validate();
        $this->editing->save();
        $this->notify("Service Provider saved successfully!");
        $this->showEditModal = false;
    }

    public function edit(ServiceProvider $provider)
    {
        if (auth()->user()->can('edit service providers'))
        {
            if ($this->editing->isNot($provider)) $this->editing = $provider;

            $this->showEditModal = true;
        }
    }

    public function confirmDelete(ServiceProvider $provider)
    {
        if (auth()->user()->can('delete service provider'))
        {
            if $this->provider->
        }

    }

    public function delete()
    {

    }

    public function makeBlankProvider()
    {
        return ServiceProvider::make();
    }

    public function getRowsQueryProperty()
    {
        $query = ServiceProvider::query()
                    ->search($this->search);

        return $this->applySorting($query);
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function render()
    {
        return view('livewire.admin.service-providers.index', ['providers' => $this->rows]);
    }
}
