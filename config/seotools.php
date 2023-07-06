<?php

return [
    'meta' => [
        /*
         * The default configurations to be used by the meta generator.
         */
        'defaults'       => [
            'title'       => env('APP_NAME'), // set false to totally remove
            'titleBefore' => false, // Put defaults.title before page title, like 'It's Over 9000! - Dashboard'
            'description' => 'A comprehensive web application offering developers a suite of tools to analyze domain information, detect broken links, access SSL certificate details, and more.',
            'separator'   => ' - ',
            'keywords'    => [''],
            'fb:app_id'   => '',
            'canonical'   => null, // Set null for using Url::current(), set false to total remove
        ],
        /*
         * Webmaster tags are always added.
         */
        'webmaster_tags' => [
            'google'    => env('GOOGLE_SITE_VERIFICATION', null),
            'bing'      => env('BING_SITE_VERIFICATION'),
            'alexa'     => null,
            'pinterest' => null,
            'yandex'    => null,
            'norton'    => null,
        ],

        'add_notranslate_class' => false,
    ],
    'opengraph' => [
        /*
         * The default configurations to be used by the opengraph generator.
         */
        'defaults' => [
            'title'       => env('APP_NAME'), // set false to total remove
            'description' => config('seotools.meta.defaults.description'), // set false to total remove
            'url'         => null, // Set null for using Url::current(), set false to total remove
            'type'        => 'website',
            'site_name'   => env('APP_NAME'),
            'images'      => [
                config('app.url') . '/images/social/general.png',
            ],
        ],
    ],
    'twitter' => [
        /*
         * The default values to be used by the twitter cards generator.
         */
        'defaults' => [
            'card'        => 'summary_large_image',
            'site'        => '@'.env('TWITTER_USERNAME'),
            'description' => config('seotools.meta.defaults.description'),
        ],
    ],
    'json-ld' => [
        /*
         * The default configurations to be used by the json-ld generator.
         */
        'defaults' => [
            'title'       => env('APP_NAME'), // set false to total remove
            'description' => config('seotools.meta.defaults.description'), // set false to total remove
            'url'         => null, // Set null for using Url::current(), set false to total remove
            'type'        => 'WebPage',
            'images'      => [
                config('app.url') . '/images/social/general.png',
            ],
        ],
    ],
];
