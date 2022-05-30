<?php

namespace App\Http\Livewire\Traits;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

trait WithEditsModels
{

    protected string $permissionPrefix;
    protected string $shortModelName;

    public function bootWithEditsModels()
    {
        $this->shortModelName = Str::of($this->modelName)->afterLast('\\');
        $this->permissionPrefix = Str::of($this->shortModelName)->plural()->lower();
    }

    public function create()
    {
        if (Gate::denies('create', $this->modelName)) return $this->denied();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankModel();

        if (method_exists($this, 'beforeCreate'))  $this->beforeCreate();

        $this->showEditModal = true;
    }

    public function edit($id)
    {
        $toEdit = $this->modelName::find($id);

        if (Gate::denies('update', $toEdit)) return $this->denied();

        if ($this->editing->isNot($toEdit)) $this->editing = $toEdit;

        if (method_exists($this, 'beforeEdit')) $this->beforeEdit();

        $this->showEditModal = true;
    }

    public function delete()
    {
        if (!$this->deleting) return;

        if (Gate::denies('delete', $this->deleting)) return $this->denied();

        if ($this->editing->is($this->deleting)) $this->editing = $this->makeBlankModel();

        $this->deleting->delete();

        $this->showDeleteConfirmation = false;

        $this->notify("{$this->shortModelName} has been deleted successfully!");
    }


    public function cancelDelete(): void
    {
        $this->deleting = null;
        $this->showDeleteConfirmation = false;
    }

    public function confirmDelete($id)
    {
        $toDelete = $this->modelName::find($id);

        if (Gate::denies('delete', $toDelete)) return $this->denied();

        $this->deleting = $toDelete;

        $this->showDeleteConfirmation = true;
    }

    public function save()
    {
        $isEditing = !!$this->editing->getKey();

        if ($isEditing && Gate::denies('update', $this->editing)) {
            return $this->denied();
        }

        if (!$isEditing && Gate::denies('create', $this->modelName)) {
            return $this->denied();
        }

        $this->validate();

        $this->editing->save();

        $this->notify("{$this->shortModelName} saved successfully.");

        $this->showEditModal = false;
    }
}
