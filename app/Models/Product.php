<?php

namespace App\Models;

use Akaunting\Money\Money;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory, Searchable;

    public $timestamps = false;
    public array $searchable = ['name'];


    public function serviceAgreements(): BelongsToMany
    {
        return $this->belongsToMany(ServiceAgreement::class)->withPivot(['qty', 'unit_price', 'name']);
    }

    public function priceString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->price*100)->format()
        );
    }
}
