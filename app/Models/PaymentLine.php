<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentLine extends Model
{
    use HasFactory;

    protected $guarded = [];
    public $timestamps = false;

    protected $casts = [
        'amount' => 'float'
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'invoice_id');
    }
    public function payment(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'transaction_id');
    }
}
