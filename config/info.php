<?php

return [
    'author' => [
        'name' => env('AUTHOR_NAME'),
        'url' => env('AUTHOR_URL'),
    ],
    'support' => [
        'url' => env('SUPPORT_URL'),
        'text' => env('SUPPORT_TEXT', 'Support my work'),
    ],
    'reporting' => [
        'email' => env('REPORTING_EMAIL'),
    ],
];
