<?php

namespace App\Models;

use App\Models\Traits\Orderable;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory, Searchable, Orderable;

    protected array $searchable = ['label', 'route'];
    protected $guarded = [];

    protected string $orderableFilter = 'menu_id';

    protected static function booted()
    {
        static::creating(function ($item) {
            $item->order = MenuItem::whereMenuId($item->menu_id)->max('order')+1;
        });
    }
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function scopeAdmin($query)
    {
        return $query->whereHas('menu', fn($query) => $query->whereName('Admin'));
    }

    public function scopeMain($query)
    {
        return $query->whereHas('menu', fn($query) => $query->whereName('Main'));
    }
}
