<?php

namespace App\Models;

use Akaunting\Money\Money;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class InvoiceLine extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function unitPriceString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->unit_price * 100)->format()
        );
    }

    public function amountString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->amount * 100)->format()
        );
    }

    public function descriptionExcerpt(): Attribute
    {
        return new Attribute(
            get: fn() => Str::of($this->description)->limit(50, '...')
        );
    }

    public function descriptionString(): Attribute
    {
        return new Attribute(
            get: fn() => Str::of($this->description)->replace("\n", "<br>\n")
        );
    }

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
