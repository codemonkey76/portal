<?php

namespace App\Models;

use Akaunting\Money\Money;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($transaction) {
            $transaction->transaction_ref = match ($transaction->type) {
                'invoice' => GlobalSetting::getNextInvoiceNo(),
                'payment' => GlobalSetting::getNextPaymentNo()
            };
        });

        static::saving(function($transaction) {
            $transaction->gst = ($transaction->type === 'invoice') ? ($transaction->total_amount / 11) : 0;
            $transaction->total_ex_gst = $transaction->total_amount - $transaction->gst;
        });
    }

    public $searchable = ['transaction_ref', 'total_amount', 'transaction_date', 'gst', 'total_ex_gst', 'type'];
    protected $casts = [
        'transaction_date' => 'date',
        'ship_date' => 'date',
        'due_date' => 'date',
        'apply_tax_after_discount' => 'boolean',
        'total_amount' => 'decimal:2',
        'sync' => 'boolean'
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

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
            get: fn() => Money::AUD(($this->type==='invoice'? $this->total_amount : -$this->total_amount) * 100)->format()
        );
    }

    public function gstString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->gst * 100)->format()
        );
    }

    public function totalExAmountString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->total_ex_gst * 100)->format()
        );
    }

    public function paymentLines(): HasMany
    {
        return $this->hasMany(PaymentLine::class);
    }
}
