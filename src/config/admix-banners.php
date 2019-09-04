<?php

return [
    'name' => 'Banners',
    'icon' => 'icon fe-monitor',
    'sort' => 20,
    'default_sort' => [
        '-is_active',
        '-star',
        '-published_at',
        'name',
    ],
    'places' => [
        'home' => [
            'name' => 'Home',
            'html' => true,
            'items' => [
                'desktop' => [
                    'width' => 1920,
                    'height' => 850,
                    'quality' => 95,
                    'crop' => true,
                ],
                'tablet' => [
                    'width' => 1366,
                    'height' => 605,
                    'quality' => 95,
                    'crop' => true,
                ],
                'mobile' => [
                    'width' => 375,
                    'height' => 600,
                    'quality' => 95,
                    'crop' => true,
                ],
            ],
        ],
//        'interna' => [
//            'name' => 'Interna',
//            'html' => false,
//            'items' => [
//                'desktop' => [
//                    'width' => 1920,
//                    'height' => 850,
//                    'quality' => 95,
//                    'crop' => true,
//                ],
//            ],
//        ],
    ],
];
