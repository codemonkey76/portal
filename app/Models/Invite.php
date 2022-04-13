<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    use Searchable;

    use HasFactory;
    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($invite) {
            $invite->token = Str::random(64);
            $invite->expires_at = now()->addDays(5);
        });

    }

    public function expiry(): Attribute
    {
        return Attribute::make(
            get: function() {
                return $this->created_at->diffForHumans();
            }
        );
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
