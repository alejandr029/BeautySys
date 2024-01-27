<?php

return [
    'name' => 'BeautySys',
    'manifest' => [
        'name' => env('APP_NAME', 'BeautySys'),
        'short_name' => 'BeautySys PWA',
        'start_url' => '/',
        'background_color' => '#ffffff',
        'theme_color' => '#000000',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> 'black',
        'icons' => [
            '72x72' => [
                'path' => '/images/icons/icon.ico',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/images/icons/icon.ico',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/images/icons/icon.ico',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/images/icons/icon.ico',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/images/icons/icon.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/images/icons/icon.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/images/icons/icon.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/images/icons/icon.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/images/icons/splash.jpg',
            '750x1334' => '/images/icons/splash.jpg',
            '828x1792' => '/images/icons/splash.jpg',
            '1125x2436' => '/images/icons/splash.jpg',
            '1242x2208' => '/images/icons/splash.jpg',
            '1242x2688' => '/images/icons/splash.jpg',
            '1536x2048' => '/images/icons/splash.jpg',
            '1668x2224' => '/images/icons/splash.jpg',
            '1668x2388' => '/images/icons/splash.jpg',
            '2048x2732' => '/images/icons/splash.jpg',
        ],
        'shortcuts' => [
            [
                'name' => 'Dashboard',
                'description' => 'Ir al Dashboard',
                'url' => '/dashboard',
                'icons' => [
                    "src" => "/images/icons/icon.ico",
                    "purpose" => "any"
                ]
            ]
        ],
        'custom' => []
    ]
];
