<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GlobalSetting extends Model
{
    use HasFactory;

    protected $primaryKey = 'key';
    public $incrementing = false;
    public $timestamps = false;
    protected $guarded = [];


    public static function getNextPaymentNo()
    {
        return static::getNextTransactionNo('payment');
    }

    public static function getNextInvoiceNo()
    {
        return static::getNextTransactionNo();
    }

    public static function getNextTransactionNo($type = 'invoice')
    {
        $key = match($type) {
            'invoice' => 'next_invoice_no',
            'payment' => 'next_payment_no'
        };

        $setting = GlobalSetting::whereKey($key)->first();
        $current = $setting->value;
        $setting->value++;
        $setting->save();
        return $current;
    }
}
