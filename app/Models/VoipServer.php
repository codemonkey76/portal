<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VoipServer extends Model
{
    use HasFactory, Searchable;

    protected $guarded = [];

    public array $searchable = ['name', 'server_url', 'api_user'];


}
