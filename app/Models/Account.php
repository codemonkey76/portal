<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory, Searchable;

    protected array $searchable = ['name', 'description', 'account_sub_type', 'qb_account_id', 'account_type'];
    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
        'active' => 'boolean',
        'sync' => 'boolean'
    ];
}
