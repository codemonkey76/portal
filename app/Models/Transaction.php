<?php

namespace App\Models;

use Akaunting\Money\Money;
use App\Enums\TransactionStatus;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Transaction extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    protected $appends = ['due_date_string', 'transaction_date_string', 'total_amount_string', 'balance_string'];

    public $searchable = ['transaction_ref', 'total_amount', 'transaction_date', 'gst', 'total_ex_gst', 'type'];
    protected $casts = [
        'transaction_date' => 'date',
        'ship_date' => 'date',
        'due_date' => 'date',
        'apply_tax_after_discount' => 'boolean',
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
        return $this->hasMany(InvoiceLine::class)->whereNot('detail_type', '=', 'SubTotalLineDetail');
    }

    public function subtotalLine(): HasOne
    {
        return $this->hasOne(InvoiceLine::class)->whereDetailType('SubTotalLineDetail');
    }

    public function transactionDateString(): Attribute
    {
        return new Attribute(
            get: fn() => $this->transaction_date?->format('d/m/Y')
        );
    }

    protected function dueDateString(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->due_date?->format('d/m/Y')
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
            get: fn() => Money::AUD(($this->type === 'invoice' ? $this->total_ex_gst : -$this->total_ex_gst)* 100)->format()
        );
    }

    public function totalPaymentsString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD(($this->total_amount - $this->balance) * 100)->format()
        );
    }
    public function balanceString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->balance * 100)->format()
        );
    }

    public function paymentLines(): HasMany
    {
        return $this->hasMany(PaymentLine::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(PaymentLine::class, 'invoice_id');
    }

    public function isInvoice(): bool
    {
        return $this->type === 'invoice';
    }

    public function status(): Attribute
    {
        return new Attribute(
            get: function() {
                if ($this->isInvoice()) {
                    if (($this->balance == $this->total_amount) && ($this->due_date > now())) return TransactionStatus::OPEN;
                    if (($this->balance > 0) && ($this->due_date < now())) return TransactionStatus::OVERDUE;
                    if (($this->balance > 0) && ($this->balance < $this->total_amount)) return TransactionStatus::PARTIAL;
                    if ($this->balance == 0) return TransactionStatus::PAID;
                    return TransactionStatus::UNKNOWN;
                }

                if ($this->total_ex_gst == 0 && $this->unapplied_amount == 0) return TransactionStatus::CLOSED;
                if ($this->unapplied_amount == $this->total_ex_gst) return TransactionStatus::UNAPPLIED;
                if ($this->unapplied_amount > 0) return TransactionStatus::PARTIAL;
                if ($this->unapplied_amount == 0) return TransactionStatus::CLOSED;

                return TransactionStatus::UNKNOWN;
            }
        );
    }

    public function scopeOutstanding($query, $payment)
    {
        $invoices = PaymentLine::whereTransactionId($payment->id)->pluck('invoice_id')->toArray();

        return $query->where('balance', '<>', 0)->orWhere(function($query) use ($invoices) {
            $query->whereIn('id', $invoices);
        });
    }
}
