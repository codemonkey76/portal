<?php

namespace App\Models;

use Akaunting\Money\Money;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductServiceAgreement extends Pivot
{
    public function unitPriceString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->unit_price * 100)->format()
        );
    }

    public function extensionString(): Attribute
    {
        return new Attribute(
            get: fn() => Money::AUD($this->unit_price * $this->qty * 100)->format()
        );
    }

}
