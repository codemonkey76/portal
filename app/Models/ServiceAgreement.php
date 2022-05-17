<?php

namespace App\Models;

use Akaunting\Money\Money;
use App\Models\Traits\DisablesTimestamps;
use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use NumberFormatter;

class ServiceAgreement extends Model
{
    use HasFactory, Searchable;

    public $timestamps = false;
    protected $guarded = [];

    public $searchable = ['address'];

    public $casts = [
        'created_at' => 'date',
        'starts_at' => 'date',
        'ends_at' => 'date'
    ];

    public function termString(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->term . " Months"
        );
    }

    public function frequencyString(): Attribute
    {
        return Attribute::make(
            get: function() {
                return match ($this->frequency) {
                    12 => "Monthly",
                    4 => "Quarterly",
                    1 => "Yearly",
                    default => "Unknown frequency",
                };
            }
        );
    }

    public function amountString(): Attribute
    {
        return Attribute::make(
            get: fn() =>
            (new NumberFormatter( 'en_AU', NumberFormatter::CURRENCY))
                ->formatCurrency($this->amount, "AUD")
        );
    }

    public function network_services(): HasMany
    {
        return $this->hasMany(NetworkService::class);
    }

    public function mobile_services(): HasMany
    {
        return $this->hasMany(MobileService::class);
    }

    public function voip_services(): HasMany
    {
        return $this->hasMany(VoipService::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    // Attributes
    public function total() : Attribute
    {
        return new Attribute(
            get: fn() =>
            ($this->network_services()->sum('price') +
                $this->mobile_services()->sum('price') +
                $this->voip_services()->sum('price')) * $this->term
        );
    }

    public function gstString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->total*10)->format()
        );
    }

    public function grandTotalString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->total * 110)->format()
        );
    }

    public function totalString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->total * 100)->format()
        );
    }

}
