<?php

namespace App\Models;

use Akaunting\Money\Money;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentAllocationLine extends Model
{
    use HasFactory;

    protected $appends = ['amount_string'];
    protected $guarded = [];

    public function paymentAllocation(): BelongsTo
    {
        return $this->belongsTo(PaymentAllocation::class);
    }

    public function transaction(): BelongsTo
    {
        return $this->belongsTo(Transaction::class);
    }

    public function transactionBalance() : Attribute
    {
        return new Attribute(
            get: fn() => $this->transaction->balance - $this->allocation
        );
    }

    public function amountString() : Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->amount * 100)->format()
        );
    }
}

