<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $casts = [
        'transaction_date' => 'date',
        'ship_date' => 'date',
        'due_date' => 'date',
        'apply_tax_after_discount' => 'boolean',
        'total_amount' => 'decimal:2',
        'sync' => 'boolean'
    ];
}
