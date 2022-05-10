<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccountClassification extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function accountTypes(): HasMany
    {
        return $this->hasMany(AccountType::class);
    }
}
