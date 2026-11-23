<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Public pages
    |--------------------------------------------------------------------------
    |
    | Titles are completed with the configured application name. Descriptions
    | are written for search results: one or two sentences, British English.
    |
    */

    'pages' => [
        'home' => [
            'route' => 'home',
            'title' => 'Browser, device and location details',
            'description' => 'See your browser, device and location details in one place and share a link with support or developers when you need help fixing a problem.',
            'shared_title' => 'Shared browser, device and location report',
            'shared_description' => 'A saved browser, device and location report. Open the link to see the same snapshot that was shared for support or debugging.',
            'image' => '/images/social/general.png',
        ],
        'browser' => [
            'route' => 'browser',
            'title' => 'Browser name, version and user agent',
            'description' => 'Check your browser name, version, user agent and rendering engine, then share the details when a website needs them to track down a bug.',
            'shared_title' => 'Shared browser name, version and user agent',
            'shared_description' => 'A saved report of the browser name, version, user agent and rendering engine, shared so support can see the same snapshot.',
            'image' => '/images/social/browser.png',
        ],
        'device' => [
            'route' => 'device',
            'title' => 'Device, operating system and screen size',
            'description' => 'View the device, operating system, IP address and screen size you are using, and share them when a problem only happens on your machine.',
            'shared_title' => 'Shared device, operating system and screen',
            'shared_description' => 'A saved report of the device, operating system, IP address and screen size, shared so support can see the same snapshot.',
            'image' => '/images/social/device.png',
        ],
        'location' => [
            'route' => 'location',
            'title' => 'Location estimated from your IP address',
            'description' => 'See the country, time zone and coordinates estimated from your IP address, and share them when a site behaves differently by location.',
            'shared_title' => 'Shared location estimated from an IP address',
            'shared_description' => 'A saved report of the country, time zone and coordinates estimated from an IP address, shared so support can see the same snapshot.',
            'image' => '/images/social/location.png',
        ],
        'missing' => [
            'route' => 'home',
            'title' => 'Page not found',
            'description' => 'This page does not exist. Go back to Browser.is to see your browser, device and location details.',
            'image' => '/images/social/general.png',
            'robots' => 'noindex, follow',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Sitemap
    |--------------------------------------------------------------------------
    |
    | Named routes included in /sitemap.xml. Shared result URLs are omitted.
    |
    */

    'sitemap' => [
        'home',
        'browser',
        'device',
        'location',
    ],

];
