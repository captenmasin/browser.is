<?php

$description = 'See your browser, device and location details in one place and share a link with support or developers when you need help fixing a problem.';

$twitterUsername = env('TWITTER_USERNAME');

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults' => [
            'title' => env('APP_NAME'), // set false to totally remove
            'titleBefore' => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description' => $description,
            'separator' => ' - ',
            'keywords' => [],
            'fb:app_id' => '',
            'canonical' => false, // Page meta sets this explicitly. False removes the fallback.
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google' => env('GOOGLE_SITE_VERIFICATION', null),
            'bing' => env('BING_SITE_VERIFICATION'),
            'alexa' => null,
            'pinterest' => null,
            'yandex' => null,
            'norton' => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title' => env('APP_NAME'), // set false to total remove
            'description' => $description, // set false to total remove
            'url' => null, // Set null for using Url::current(), set false to total remove
            'type' => 'website',
            'site_name' => env('APP_NAME'),
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => array_filter([
            'card' => 'summary_large_image',
            'site' => is_string($twitterUsername) && $twitterUsername !== ''
                ? '@'.ltrim($twitterUsername, '@')
                : null,
            'description' => $description,
        ]),
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title' => env('APP_NAME'), // set false to total remove
            'description' => $description, // set false to total remove
            'url' => null, // Set null for using Url::current(), set false to total remove
            'type' => 'WebPage',
            'images' => [
                config('app.url').'/images/social/general.png',
            ],
        ],
    ],
];
