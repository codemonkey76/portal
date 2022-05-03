<?php

namespace App\Http\Livewire\Traits;

use App\Models\MenuItem;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

trait WithEditsMenus
{
    use WithAuthorizationMessage;

    protected $perPageVariable = "menusPerPage";
    public $showEditModal = false;
    public $routes = [];
    public $permissions = [];
    public MenuItem $editing;
    public $menu_id;

    protected function rules()
    {
        return [
            'editing.menu_id' => Rule::in($this->menu_id),
            'editing.label' => 'required|string|max:25',
            'editing.route' => Rule::in($this->routes),
            'editing.permission_required' => ['nullable', Rule::in($this->permissions)],
            'editing.icon' => 'required|string'
        ];
    }

    public function increment(MenuItem $item): void
    {
        $item->incrementOrder();
    }

    public function decrement(MenuItem $item): void
    {
        $item->decrementOrder();
    }

    public function edit(MenuItem $item)
    {
        if (auth()->user()->cannot('menus.update')) return$this->denied();

        if ($this->editing->isNot($item)) $this->editing = $item;

        $this->showEditModal = true;
    }

    public function create()
    {
        if (auth()->user()->cannot('menus.create')) return $this->denied();

        if ($this->editing->getKey()) $this->editing = $this->makeBlankMenuItem();

        $this->showEditModal = true;
    }

    public function delete(MenuItem $item)
    {
        if (auth()->user()->cannot('menus.destroy')) return $this->denied();

        if ($item->route === 'menus.index')
        {
            $this->notify("Can't delete the menu for the menus, this would break the system.");
            return;
        }

        $item->delete();
        $this->resetPage();
        $this->notify("Deleted successfully");
    }

    public function save()
    {
        $isEditing = !!$this->editing->getKey();

        if ($isEditing && auth()->user()->cannot('menus.update')) return $this->denied();

        if (!$isEditing && auth()->user()->cannot('menus.create')) return $this->denied();

        info(json_encode($this->editing));
        $this->validate();
        $this->editing->save();
        $this->notify("Menu item saved successfully!");
        $this->showEditModal = false;
    }

    public function getRowsProperty()
    {
        return $this->applyPagination($this->rowsQuery);
    }

    public function makeBlankMenuItem()
    {
        return MenuItem::make([
            'menu_id' => $this->menu_id
        ]);
    }

    protected function getRoutes(): array
    {
        $routeCollection = Route::getRoutes();

        $routes = [];

        foreach($routeCollection as $route)
        {
            if (in_array('GET', $route->methods) && !empty($route->getName()))
                $routes[] = $route->getName();
        }

        return collect($routes)->sort()->values()->toArray();
    }
}
