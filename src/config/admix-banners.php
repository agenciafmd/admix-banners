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
//        ],
    ],
];
