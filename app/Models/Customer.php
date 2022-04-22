<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory, Searchable;

    protected $searchable = ['company_name', 'phone', 'email'];

    protected $casts = [
        'status' => 'boolean',
        'sync' => 'boolean'
    ];

    protected $guarded = [];

    public function invites()
    {
        return $this->hasMany(Invite::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function primary_users()
    {
        return $this->hasMany(User::class, 'primary_customer_id');
    }
}
