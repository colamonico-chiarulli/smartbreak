<?php

return [
    'name' => 'SmartBreak',
    'manifest' => [
        'name' => 'SmartBreak',
        'short_name' => 'SmartBreak',
        'start_url' => '/',
        'background_color' => '#007bff',
        'theme_color' => '#007bff',
        'display' => 'standalone',
        'orientation'=> 'any', //Rino
        'status_bar'=> '#007bff',
        'icons' => [
            '192x192' => [
                'path' => '/pwa-assets/manifest-icon-192.png',
                'purpose' => 'any'
            ],
            '512x512' => [
                'path' => '/pwa-assets/manifest-icon-512.png',
                'purpose' => 'any'
            ],
        ],
        'splash' => [
            '640x1136' => '/pwa-assets/apple-splash-640x-136.jpg',
            '750x1334' => '/pwa-assets/apple-splash-750x-334.jpg',
            '828x1792' => '/pwa-assets/apple-splash-828x-792.jpg',
            '1125x2436' => '/pwa-assets/apple-splash-1125-2436.jpg',
            '1242x2208' => '/pwa-assets/apple-splash-1242-2208.jpg',
            '1242x2688' => '/pwa-assets/apple-splash-1242-2688.jpg',
            '1536x2048' => '/pwa-assets/apple-splash-1536-2048.jpg',
            '1668x2224' => '/pwa-assets/apple-splash-1668-2224.jpg',
            '1668x2388' => '/pwa-assets/apple-splash-1668-2388.jpg',
            '2048x2732' => '/pwa-assets/apple-splash-2048-2732.jpg',
        ],
        'shortcuts' => [
            /*
            [
                'name' => 'Shortcut Link 1',
                'description' => 'Shortcut Link 1 Description',
                'url' => '/shortcutlink1',
                'icons' => [
                    "src" => "/images/icons/icon-72x72.png",
                    "purpose" => "any"
                ]
            ],
            [
                'name' => 'Shortcut Link 2',
                'description' => 'Shortcut Link 2 Description',
                'url' => '/shortcutlink2'
            ]
            */
        ],
        'custom' => []
    ]
];
