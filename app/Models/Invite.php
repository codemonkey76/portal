<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use App\Notifications\InviteUser;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Prunable;
use Illuminate\support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Invite extends Model
{
    use Searchable, Notifiable, Prunable;

    use HasFactory;

    protected $guarded = [];

    protected $searchable = ['name', 'email'];

    protected $casts = [
        'expires_at' => 'datetime'
    ];


    public function prunable()
    {
        return static::where('expires_at', '<', now());
    }

    protected static function booted()
    {
        static::creating(function ($invite) {
            $invite->token = Str::random(64);
            $invite->expires_at = now()->addDays(config('app.settings.invitation_expiry'));
        });
        static::created(function ($invite) {
            $invite->notify(new InviteUser($invite->token));
        });
    }

    public function scopeNotExpired($query)
    {
        return $query->where('expires_at', '>', now());
    }

    public function expiry(): Attribute
    {
        return Attribute::make(
            get: function() {
                return $this->expires_at->diffForHumans();
            }
        );
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
