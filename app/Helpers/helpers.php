<?php

use App\Models\GlobalSetting;

function settings(string $setting): string
{
    return GlobalSetting::find($setting)?->value ?? '';
}
