<?php

use App\Models\Setting;


if (!function_exists('setting')) {
    function setting($key, $default = null)
    {
        $setting = Setting::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }
}

function localize($model, $field)
{
    $locale = app()->getLocale();
    return $locale === 'hi' && isset($model->{$field . '_hi'})
        ? $model->{$field . '_hi'}
        : $model->{$field};
}

