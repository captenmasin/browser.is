<?php

return [
    'manifest' => [
        'id'                          => env('APP_URL'),
        'name'                        => env('APP_NAME'),
        'short_name'                  => env('APP_NAME'),
        'start_url'                   => env('APP_URL'),
        'display'                     => 'minimal-ui',
        'categories'                  => ['utilities'],
        'description'                 => 'Discover the ultimate collection of SEO tools for developers! ' . env('APP_NAME') . ' hosts multiple tools to check and optimize your website\'s search engine performance. From keyword research to meta tag optimization, we\'ve got you covered. Experience the power of comprehensive SEO analysis and take your website to the next level with our user-friendly tools.',
        'background_color'            => '#FFFFFF',
        'dark_background_color'       => '#111827',
        'theme_color'                 => '#7c3aed',
        'orientation'                 => 'any',
        'status_bar'                  => '#F1F5F9',
        'splash'                      => [
            '640x1136'  => config('app.url') . '/images/pwa/splash/640x1136.jpeg',
            '750x1334'  => config('app.url') . '/images/pwa/splash/750x1334.jpeg',
            '828x1792'  => config('app.url') . '/images/pwa/splash/828x1792.jpeg',
            '1125x2436' => config('app.url') . '/images/pwa/splash/1125x2436.jpeg',
            '1136x640'  => config('app.url') . '/images/pwa/splash/1136x640.jpeg',
            '1170x2532' => config('app.url') . '/images/pwa/splash/1170x2532.jpeg',
            '1242x2208' => config('app.url') . '/images/pwa/splash/1242x2208.jpeg',
            '1242x2688' => config('app.url') . '/images/pwa/splash/1242x2688.jpeg',
            '1284x2778' => config('app.url') . '/images/pwa/splash/1284x2778.jpeg',
            '1334x750'  => config('app.url') . '/images/pwa/splash/1334x750.jpeg',
            '1536x2048' => config('app.url') . '/images/pwa/splash/1536x2048.jpeg',
            '1620x2160' => config('app.url') . '/images/pwa/splash/1620x2160.jpeg',
            '1668x2224' => config('app.url') . '/images/pwa/splash/1668x2224.jpeg',
            '1668x2388' => config('app.url') . '/images/pwa/splash/1668x2388.jpeg',
            '1792x828'  => config('app.url') . '/images/pwa/splash/1792x828.jpeg',
            '2048x1536' => config('app.url') . '/images/pwa/splash/2048x1536.jpeg',
            '2048x2732' => config('app.url') . '/images/pwa/splash/2048x2732.jpeg',
            '2160x1620' => config('app.url') . '/images/pwa/splash/2160x1620.jpeg',
            '2208x1242' => config('app.url') . '/images/pwa/splash/2208x1242.jpeg',
            '2224x1668' => config('app.url') . '/images/pwa/splash/2224x1668.jpeg',
            '2388x1668' => config('app.url') . '/images/pwa/splash/2388x1668.jpeg',
            '2436x1125' => config('app.url') . '/images/pwa/splash/2436x1125.jpeg',
            '2532x1170' => config('app.url') . '/images/pwa/splash/2532x1170.jpeg',
            '2688x1242' => config('app.url') . '/images/pwa/splash/2688x1242.jpeg',
            '2732x2048' => config('app.url') . '/images/pwa/splash/2732x2048.jpeg',
            '2778x1284' => config('app.url') . '/images/pwa/splash/2778x1284.jpeg',
        ],
        'icons'                       => [
            [
                'src'     => config('app.url') . '/images/pwa/icons/144x144-maskable.png',
                'type'    => 'image/png',
                'sizes'   => '144x144',
                'purpose' => 'any',
            ],
            [
                'src'     => config('app.url') . '/images/pwa/icons/144x144-maskable.png',
                'type'    => 'image/png',
                'sizes'   => '144x144',
                'purpose' => 'maskable',
            ],
            [
                'src'     => config('app.url') . '/images/pwa/icons/192x192.png',
                'type'    => 'image/png',
                'sizes'   => '192x192',
                'purpose' => 'any',
            ],
            [
                'src'     => config('app.url') . '/images/pwa/icons/192x192-maskable.png',
                'type'    => 'image/png',
                'sizes'   => '192x192',
                'purpose' => 'maskable',
            ],
            [
                'src'     => config('app.url') . '/images/pwa/icons/512x512.png',
                'type'    => 'image/png',
                'sizes'   => '512x512',
                'purpose' => 'any',
            ],
            [
                'src'     => config('app.url') . '/images/pwa/icons/512x512-maskable.png',
                'sizes'   => '512x512',
                'type'    => 'image/png',
                'purpose' => 'maskable',
            ],
            [
                'src'     => config('app.url') . '/images/pwa/icons/512x512-monochrome.png',
                'sizes'   => '512x512',
                'type'    => 'image/png',
                'purpose' => 'monochrome',
            ],
            [
                'src'     => config('app.url') . '/images/pwa/icons/1024x1024-monochrome.png',
                'sizes'   => '1024x1024',
                'type'    => 'image/png',
                'purpose' => 'monochrome',
            ],
        ],
        'shortcuts'                   => [
            [
                'name'        => config('app_tools.items.links.name'),
                'short_name'  => 'Links',
                'description' => config('app_tools.items.links.description'),
                'url'         => config('app.url') . '/links',
                'icons'       => [
                    ['src' => config('app_tools.items.links.shortcut_192'), 'sizes' => '192x192'],
                    ['src' => config('app_tools.items.links.shortcut_96'), 'sizes' => '96x96'],
                ],
            ],
            [
                'name'        => config('app_tools.items.social.name'),
                'short_name'  => 'Social',
                'description' => config('app_tools.items.social.description'),
                'url'         => config('app.url') . '/social',
                'icons'       => [
                    ['src' => config('app_tools.items.social.shortcut_192'), 'sizes' => '192x192'],
                    ['src' => config('app_tools.items.social.shortcut_96'), 'sizes' => '96x96'],
                ],
            ],
            [
                'name'        => config('app_tools.items.lighthouse.name'),
                'short_name'  => 'Lighthouse',
                'description' => config('app_tools.items.lighthouse.description'),
                'url'         => config('app.url') . '/lighthouse',
                'icons'       => [
                    ['src' => config('app_tools.items.lighthouse.shortcut_192'), 'sizes' => '192x192'],
                    ['src' => config('app_tools.items.lighthouse.shortcut_96'), 'sizes' => '96x96'],
                ],
            ],
            [
                'name'        => config('app_tools.items.domain.name'),
                'short_name'  => 'Domain',
                'description' => config('app_tools.items.domain.description'),
                'url'         => config('app.url') . '/domain',
                'icons'       => [
                    ['src' => config('app_tools.items.domain.shortcut_192'), 'sizes' => '192x192'],
                    ['src' => config('app_tools.items.domain.shortcut_96'), 'sizes' => '96x96'],
                ],
            ],
            [
                'name'        => config('app_tools.items.certificate.name'),
                'short_name'  => 'SSL',
                'description' => config('app_tools.items.certificate.description'),
                'url'         => config('app.url') . '/certificate',
                'icons'       => [
                    ['src' => config('app_tools.items.certificate.shortcut_192'), 'sizes' => '192x192'],
                    ['src' => config('app_tools.items.certificate.shortcut_96'), 'sizes' => '96x96'],
                ],
            ],
        ],
        'dir'                         => 'ltr',
        'lang'                        => 'en',
        'display_override'            => [
            'standalone',
            'browser',
            'window-controls-overlay'
        ],
        'screenshots'           => [
            [
                'src'   => config('app.url').'/images/pwa/screenshots/1.png',
                'sizes' => '1080x1920',
                'type'  => 'image/png',
            ],
            [
                'src'   => config('app.url').'/images/pwa/screenshots/2.png',
                'sizes' => '1080x1920',
                'type'  => 'image/png',
            ],
            [
                'src'   => config('app.url').'/images/pwa/screenshots/3.png',
                'sizes' => '1080x1920',
                'type'  => 'image/png',
            ],
            [
                'src'   => config('app.url').'/images/pwa/screenshots/4.png',
                'sizes' => '1080x1920',
                'type'  => 'image/png',
            ],
        ],
        'scope' => config('app.url'),
        'prefer_related_applications' => false,
        'edge_side_panel'             => [
            'preferred_width' => 500
        ],
        'handle_links'                => 'auto',
        'launch_handler'              => [
            'client_mode' => ['navigate-existing', 'auto']
        ],
        'protocol_handlers'           => [
            [
                'protocol' => 'web+seo',
                'url'      => '/links?url=%s'
            ]
        ]
    ],
];
