<?php

namespace App\Models;

use Akaunting\Money\Money;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Invoice extends Model
{
    use HasFactory, Searchable;

    public $searchable = ['id', 'total_amount', 'transaction_date'];
    protected $guarded = [];
    protected $casts = [
        'transaction_date' => 'date',
        'ship_date' => 'date',
        'due_date' => 'date',
        'apply_tax_after_discount' => 'boolean',
        'total_amount' => 'decimal:2',
        'sync' => 'boolean'
    ];

    public function serviceAgreement() : BelongsTo
    {
        return $this->belongsTo(ServiceAgreement::class);
    }

    public function invoiceLines(): HasMany
    {
        return $this->hasMany(InvoiceLine::class);
    }

    public function transactionDateString(): Attribute
    {
        return new Attribute(
            get: fn() => $this->transaction_date->format('d/m/Y')
        );
    }

    public function totalAmountString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->total_amount * 100)->format()
        );
    }

    public function gstString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->total_amount * 10)->format()
        );
    }

    public function totalIncAmountString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->total_amount * 110)->format()
        );
    }
}
