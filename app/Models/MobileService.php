<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MobileService extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function service_agreement(): BelongsTo
    {
        return $this->belongsTo(ServiceAgreement::class);
    }

    public function service_provider(): BelongsTo
    {
        return $this->belongsTo(ServiceProvider::class);
    }
}
