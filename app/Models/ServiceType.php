<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceType extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected static function booted()
    {
        static::addGlobalScope('order', fn(Builder $builder) => $builder->orderBy('name', 'asc'));
    }
}
