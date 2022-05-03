<?php

namespace App\Http\Livewire\Admin\ServiceProviders;

use App\Http\Livewire\Traits\WithAuthorizationMessage;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\ServiceProvider;
use Livewire\Component;

class Index extends Component
{
    use WithSearch, WithSorting, WithPerPagePagination, WithAuthorizationMessage;

    protected string $perPageVariable="providersPerPage";

    public bool $showEditModal = false;
    public bool $showDeleteModal = false;
    public ServiceProvider $editing;


    public function create()
    {
        if (auth()->user()->cannot('service-providers.create'))
            return $this->denied();

        if ($this->editing->getKey())
            $this->editing = $this->makeBlankProvider();

        $this->showEditModal = true;
    }

    public function save()
    {
        $isEditing = !!$this->editing->getKey();

        if ($isEditing && auth()->user()->cannot('service-providers.update'))
            return $this->denied();

        if (!$isEditing && auth()->user()->cannot('service-providers.create'))
            return $this->denied();

        $this->validate();
        $this->editing->save();
        $this->notify("Service Provider saved successfully!");
        $this->showEditModal = false;
    }

    public function edit(ServiceProvider $provider)
    {
        if (auth()->user()->cannot('service-providers.update'))
            return $this->denied();

        if ($this->editing->isNot($provider))
            $this->editing = $provider;

        $this->showEditModal = true;
    }

    public function confirmDelete(ServiceProvider $provider)
    {
        if (auth()->user()->cannot('service-providers.destroy'))
            return $this->denied();

        if ($provider->network_services()->count() ||
            $provider->mobile_services()->count())
            return $this->denied("This provider is being used by existing services, cannot delete.");

        $this->showDeleteModal = true;
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
