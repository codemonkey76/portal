<?php

namespace App\Models;

use Akaunting\Money\Money;
use App\Models\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use NumberFormatter;

class ServiceAgreement extends Model
{
    use HasFactory, Searchable, Notifiable;

    public $timestamps = false;
    protected $guarded = [];

    public array $searchable = ['company_name', 'billing_address', 'billing_suburb'];

    public $casts = [
        'created_at'        => 'date',
        'approximate_start' => 'date',
        'approximate_end'   => 'date',
        'start'             => 'date',
        'end'               => 'date'
    ];

    protected static function booted()
    {
        static::creating(function ($serviceAgreement) {
            $serviceAgreement->token = Str::random(64);
            $serviceAgreement->expires_at = now()->addDays(config('app.settings.service_agreement_expiry'));
        });

        static::saving(function ($serviceAgreement) {
            if ($serviceAgreement->start) {
                $serviceAgreement->end = $serviceAgreement->start->addMonths($serviceAgreement->term);
            }
        });
    }

    public function statusColor(): Attribute
    {
        return new Attribute(
            get: fn() => match ($this->status) {
                'pending' => 'yellow',
                'sent' => 'blue',
                'waiting' => 'violet',
                'active' => 'green',
                'scheduled' => 'cyan',
                'expired' => 'red',
                default => 'gray'
            }
        );
    }

    public function status(): Attribute
    {
        return new Attribute(
            get: fn() => !$this->sent_at ? 'pending' : (
            !$this->signed_at ? 'sent' : (
            !$this->start ? 'waiting' : (
            $this->start > now() ? 'scheduled' : (
            $this->start < now() && $this->end > now() ? 'active' : 'expired'
            ))))
        );
    }

    public function termString(): Attribute
    {
        return new Attribute(
            get: fn() => $this->term." Months"
        );
    }

    public function frequencyString(): Attribute
    {
        return new Attribute(
            get: function () {
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
        return new Attribute(
            get: fn() => (new NumberFormatter('en_AU', NumberFormatter::CURRENCY))
                ->formatCurrency($this->amount, "AUD")
        );
    }

    public function networkServices(): HasMany
    {
        return $this->hasMany(NetworkService::class);
    }

    public function mobileServices(): HasMany
    {
        return $this->hasMany(MobileService::class);
    }

    public function voipServices(): HasMany
    {
        return $this->hasMany(VoipService::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot(['qty', 'unit_price', 'name']);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }


    // Attributes
    public function total(): Attribute
    {
        return new Attribute(
            get: fn() => ($this->networkServices()->sum('price') +
                    $this->mobileServices()->sum('price') +
                    $this->voipServices()->sum('price')) * $this->term
        );
    }

    public function productTotal(): Attribute
    {
        return new Attribute(
            get: fn() => $this->products()->sum(DB::raw('unit_price * qty'))
        );
    }

    public function productTotalString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->productTotal * 100)->format()
        );
    }

    public function productGstString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->productTotal * 10)->format()
        );
    }

    public function productGrandTotalString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->productTotal * 110)->format()
        );
    }

    public function gstString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->total * 10)->format()
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

    public function routeNotificationForMail($notification)
    {
        return [$this->customer->email => $this->customer->company_name];
    }

    public function scopeActive(Builder $query)
    {
        return $query->whereNotNull('signed_at')
                     ->whereNotNull('start')
                     ->where('start', '<', now())
                     ->where('end', '>', now());
    }

}
