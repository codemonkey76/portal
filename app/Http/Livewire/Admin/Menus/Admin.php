<?php

namespace App\Http\Livewire\Admin\Menus;

use App\Http\Livewire\Traits\WithEditsMenus;
use App\Http\Livewire\Traits\WithPerPagePagination;
use App\Http\Livewire\Traits\WithSearch;
use App\Http\Livewire\Traits\WithSorting;
use App\Models\Menu;
use App\Models\MenuItem;


use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Admin extends Component
{
    use WithSearch, WithPerPagePagination, WithEditsMenus;

    public function getRowsQueryProperty()
    {
        return MenuItem::query()
            ->search($this->search)
            ->admin()
            ->orderBy('order', 'asc');
    }

    public function mount()
    {
        $this->menu_id = Menu::query()->admin()->first()->id;

        $this->editing = $this->makeBlankMenuItem();

        $this->routes = $this->getRoutes();

        $this->permissions = Permission::orderBy('name')->pluck('name')->toArray();
    }

    public function render()
    {
        return view('livewire.admin.menus.admin', ['items' => $this->rows]);
    }
}
