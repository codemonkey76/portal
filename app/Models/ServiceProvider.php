<?php

namespace App\Models;

use App\Models\Traits\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceProvider extends Model
{
    use HasFactory, Searchable;


    public $searchable = ['name', 'type'];

    public function mobile_services()
    {
        return $this->hasMany(MobileService::class);
    }

    public function network_services()
    {
        return $this->hasMany(NetworkService::class);
    }
}
