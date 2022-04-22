<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MenuItem extends Model
{
    use HasFactory, Searchable;

    protected $searchable = ['label', 'route'];
    protected $guarded = [];


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

    public function incrementOrder()
    {
        DB::transaction(function() {
            if ($this->order === MenuItem::whereMenuId($this->menu_id)->max('order')) return; //Already the biggest don't increment anything

            // Retrieve the next largest ordered item to swap order with
            $item = MenuItem::query()
                ->whereMenuId($this->menu_id)
                ->where('order', '>', $this->order)
                ->orderBy('order', 'desc')
                ->first();

            info("Updating ID: {$this->id}");
            info("Also updating ID: {$item->id}");
            $item->update(['order' => $this->order]);
            $this->update(['order' => $this->order+1]);
        });
    }

    public function decrementOrder()
    {
        DB::transaction(function() {
            if ($this->order === 1) return; // Already the smallest don't decrement anything

            // Retrieve the next smallest ordered item to swap order with
            $item = MenuItem::query()
            ->whereMenuId($this->menu_id)
            ->where('order', '<', $this->order)
            ->orderBy('order', 'asc')
            ->first();

            $item->update(['order' => $this->order]);
            $this->update(['order' => $this->order - 1]);

        });
    }

}
