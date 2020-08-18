<?php

return [
    'ga' => [
        'id' => env('GOOGLE_ANALYTICS_ID', null)
    ],
    'fathom' => [
        'live_id' => env('FATHOM_ANALYTICS_ID', null),
        'staging_id' => env('FATHOM_ANALYTICS_ID_STAGING', null)
    ],
];