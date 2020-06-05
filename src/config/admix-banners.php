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
    'locations' => [
        'home' => [
            'name' => 'Home',
            'html' => false,
            'meta' => false,
            'items' => [
                'desktop' => [
                    'width' => 1920,
                    'height' => 850,
                    'quality' => 95,
                    'optimize' => true,
                    'crop' => true,
                ],
                'tablet' => [
                    'width' => 1366,
                    'height' => 605,
                    'quality' => 95,
                    'optimize' => true,
                    'crop' => true,
                ],
                'mobile' => [
                    'width' => 375,
                    'height' => 600,
                    'quality' => 95,
                    'optimize' => true,
                    'crop' => true,
                ],
            ],
        ],
//        'interna' => [
//            'name' => 'Interna',
//            'html' => false,
//            'meta' => [
//                [
//                    'label' => 'tipo',
//                    'name' => 'type',
//                    'options' => [
//                        'Plantas Baixas',
//                        'Implantações',
//                    ],
//                ],
//                [
//                    'label' => 'título',
//                    'name' => 'title',
//                ],
//                [
//                    'label' => 'subtítulo',
//                    'name' => 'subtitle',
//                ],
//            ],
//            'items' => [
//                'desktop' => [
//                    'width' => 1920,
//                    'height' => 850,
//                    'quality' => 95,
//                    'optimize' => true,
//                    'crop' => true,
//                ],
//            ],
//        ],
    ],
];
