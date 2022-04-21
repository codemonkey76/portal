<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CustomerUser extends Pivot
{
    public static function booted()
    {
        static::saving(function ($item) {
            info(json_encode($item));
        });
    }
}
