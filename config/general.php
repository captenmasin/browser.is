<?php

use Illuminate\Support\Str;

return [
    'ga' => [
        'id' => env('GOOGLE_ANALYTICS_ID', null)
    ],
    'is_staging' => Str::contains(url()->current(), 'staging')
];