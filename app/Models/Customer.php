<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory, Searchable;

    protected array $searchable = ['company_name', 'phone', 'email'];

    protected $casts = [
        'status' => 'boolean',
        'sync' => 'boolean'
    ];

    protected $guarded = [];

    public function invites(): HasMany
    {
        return $this->hasMany(Invite::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function pendingCharges(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot(['qty', 'unit_price', 'name']);
    }

    public function primaryUsers(): HasMany
    {
        return $this->hasMany(User::class, 'primary_customer_id');
    }

    public function serviceAgreements(): HasMany
    {
        return $this->hasMany(ServiceAgreement::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Transaction::class)->whereType('invoice');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Transaction::class)->whereType('payment');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function billingAddress(): HasOne
    {
        return $this->hasOne(Address::class);
    }

    public function billingAddressString(): Attribute
    {
        return new Attribute(
            get: fn() => "{$this->billingAddress?->line1}, {$this->billingAddress?->city} {$this->billingAddress?->state} {$this->billingAddress?->postal_code}" . ($this->billingAddress?->country ? ", {$this->billingAdress?->country}" : "")
        );
    }

    public function terms() : BelongsTo
    {
        return $this->belongsTo(Term::class);
    }

    public static function setCompanyNamesFromFqn()
    {
        Customer::each(function($c) {
            $words = explode(' ', $c->fully_qualified_name);

            if (is_numeric($words[0])) unset($words[0]);

            $c->update(['company_name' => implode(' ', $words)]);
        });
    }
}
