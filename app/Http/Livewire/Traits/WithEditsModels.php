<?php

namespace App\Http\Livewire\Traits;

trait WithEditsModels
{

    public function create()
    {
        if (auth()->user()->cannot($this->createPermission)) return $this->denied();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankModel();

        $this->showEditModal = true;
    }

    public function edit($id)
    {
        $toEdit = $this->modelName::find($id);

        if (auth()->user()->cannot($this->updatePermission)) return $this->denied();

        if ($this->editing->isNot($toEdit)) $this->editing = $toEdit;

        $this->showEditModal = true;
    }

    public function delete()
    {

    }

    public function confirmDelete($id)
    {
        $toDelete = $this->modelName::find($id);

        if (auth()->user()->cannot($this->destroyPermission)) return $this->denied();

        $this->deleting = $toDelete;

        $this->showDeleteConfirmation = true;
    }

    public function save()
    {

    }
}
