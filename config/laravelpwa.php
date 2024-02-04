<?php

return [
    'name' => 'BeautySys Progressive Web App',
    'manifest' => [
        'name' => env('APP_NAME', 'BeautySys Progressive Web App'),
        'short_name' => 'Beautysys App',
        'start_url' => '/',
        'background_color' => '#fff',
        'theme_color' => '#00000000',
        'display' => 'standalone',
        'orientation'=> 'any',
        'status_bar'=> '#fff',
        'screenshots' => [
            [
                'src' => '/images/screenshots/landingPage.png',
                'type' => 'image/png',
                'form_factor' => 'wide',
                'label' => 'Landing Page'
            ],
            [
                'src' => '/images/screenshots/landingPage.png',
                'type' => 'image/png',
                'label' => 'Landing Page'
            ]
        ],
        'description' => 'BeautySys: Sistema de Gestion y Administracion para clinica de cirugias esteticas.',
        'icons' => [
            '72x72' => [
                'path' => '/images/icons/icon-72x72.png',
                'purpose' => 'any'
            ],
            '96x96' => [
                'path' => '/images/icons/icon-96x96.png',
                'purpose' => 'any'
            ],
            '128x128' => [
                'path' => '/images/icons/icon-128x128.png',
                'purpose' => 'any'
            ],
            '144x144' => [
                'path' => '/images/icons/icon-144x144.png',
                'purpose' => 'any'
            ],
            '152x152' => [
                'path' => '/images/icons/icon-152x152.png',
                'purpose' => 'any'
            ],
            '192x192' => [
                'path' => '/images/icons/icon-192x192.png',
                'purpose' => 'any'
            ],
            '384x384' => [
                'path' => '/images/icons/icon-384x384.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/images/icons/icon-512x512.png',
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
                    'src' => '/images/icons/icon-96x96.png',
                    'purpose' => 'any'
                ]
            ]
        ],
        'custom' => []
    ]
];
