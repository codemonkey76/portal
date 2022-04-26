<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\DB;

trait Orderable
{
    protected ?string $defaultOrderable = 'order';
    protected ?string $defaultOrderableFilter = null;

    public function incrementOrder(): void
    {
        $orderable = $this->orderable ?? $this->defaultOrderable;
        $filter = $this->orderableFilter ?? $this->defaultOrderableFilter;

        DB::transaction(function() use ($orderable, $filter) {
            if ($this->{$orderable} === static::where($filter, $this->{$filter})->max($orderable)) return; //Already the biggest don't increment anything

            // Retrieve the next largest ordered item to swap order with
            $item = static::query()
                            ->when($filter, fn($query) => $query->where($filter, $this->{$filter}))
                            ->where($orderable, '>', $this->{$orderable})
                            ->orderBy($orderable, 'asc')
                            ->first();

            $item->update([$orderable => $this->{$orderable}]);
            $this->update([$orderable => $this->{$orderable}+1]);
        });
    }

    public function decrementOrder(): void
    {
        $orderable = $this->orderable ?? $this->defaultOrderable;
        $filter = $this->orderableFilter ?? $this->defaultOrderableFilter;

        DB::transaction(function() use ($orderable, $filter) {

            if ($this->{$orderable} === 1) return; // Already the smallest don't decrement anything

            // Retrieve the next smallest ordered item to swap order with
            $item = static::query()
                            ->when($filter, fn($query) => $query->where($filter, $this->{$filter}))
                            ->where($orderable, '<', $this->{$orderable})
                            ->orderBy($orderable, 'desc')
                            ->first();

            $item->update([$orderable => $this->{$orderable}]);
            $this->update([$orderable => $this->{$orderable} - 1]);
        });
    }
}
