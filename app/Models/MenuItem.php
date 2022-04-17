<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory, Searchable;

    protected $searchable = ['label', 'route'];
    protected $guarded = [];

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
