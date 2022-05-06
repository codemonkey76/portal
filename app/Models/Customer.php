<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function primary_users(): HasMany
    {
        return $this->hasMany(User::class, 'primary_customer_id');
    }

    public function service_agreements(): HasMany
    {
        return $this->hasMany(ServiceAgreement::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }


    public function billingAddressString(): Attribute
    {
        return new Attribute(
            get: fn() => "{$this->billing_address}, {$this->billing_suburb} {$this->billing_state} {$this->billing_postcode}, {$this->billing_country}"
        );
    }

}
