<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

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
