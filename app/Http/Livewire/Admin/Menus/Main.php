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

class Main extends Component
{
    use WithSearch, WithPerPagePagination, WithSorting, WithEditsMenus;

    public function getRowsQueryProperty()
    {
        $query = MenuItem::query()
            ->search($this->search)
            ->main();

        return $this->applySorting($query);
    }

    public function mount()
    {
        $this->menu_id = Menu::query()->main()->first()->id;

        $this->editing = $this->makeBlankMenuItem();

        $this->routes = $this->getRoutes();

        $this->permissions = Permission::orderBy('name')->pluck('name')->toArray();
    }

    public function render()
    {
        return view('livewire.admin.menus.main', ['items' => $this->rows]);
    }
}
