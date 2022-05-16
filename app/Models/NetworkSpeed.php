<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NetworkSpeed extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected static function booted()
    {
        static::addGlobalScope('order', fn(Builder $builder) => $builder
            ->orderBy('download', 'asc')
            ->orderBy('upload', 'asc')
        );
    }

    public function serviceType(): BelongsTo
    {
        return $this->belongsTo(ServiceType::class);
    }

}
