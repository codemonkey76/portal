<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AccountType extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];

    public function accountSubTypes(): HasMany
    {
        return $this->hasMany(AccountSubType::class);
    }

    public function accountClassification(): BelongsTo
    {
        return $this->belongsTo(AccountClassification::class);
    }

    public function defaultSubType(): belongsTo
    {
        return $this->belongsTo(AccountSubType::class, 'default_account_subtype_id');
    }
}
