<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class AccountSubType extends Model
{
    use HasFactory;
    public $timestamps = false;

    public function accountType(): BelongsTo
    {
        return $this->belongsTo(AccountType::class);
    }
}
