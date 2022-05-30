<?php

namespace App\Models;

use Akaunting\Money\Money;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MobileService extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function serviceAgreement(): BelongsTo
    {
        return $this->belongsTo(ServiceAgreement::class);
    }

    public function serviceProvider(): BelongsTo
    {
        return $this->belongsTo(ServiceProvider::class);
    }

    public function priceString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->price*100)->format()
        );
    }
}
