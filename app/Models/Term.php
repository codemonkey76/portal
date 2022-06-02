<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function getDueDate(Carbon $date): Carbon
    {
        return $date->clone()->addDays($this->due_days);
    }

}
