<?php

return [
    'name' => 'Banners',
    'icon' => 'device-desktop',
    'sort' => 110,
    'locations' => [
        'home' => [
            'files' => [
                'desktop' => [
                    'max' => 4096,
                    'max_width' => 3600,
                    'max_height' => 1700,
                    'crop_config' => [
                        //            'aspectRatio' => round(3600 / 1700, 2),
                    ],
                    'show_meta' => false,
                    'media' => '(min-width: 1400px)',
                ],
                'notebook' => [
                    'max' => 2048,
                    'max_width' => 2080,
                    'max_height' => 1080,
                    'crop_config' => [
                        //            'aspectRatio' => round(2160 / 1660, 2),
                    ],
                    'show_meta' => false,
                    'media' => '(min-width: 768px)',
                ],
                'mobile' => [
                    'max' => 2048,
                    'max_width' => 1360,
                    'max_height' => 2380,
                    'crop_config' => [
                        //            'aspectRatio' => round(1360 / 2380, 2),
                    ],
                    'show_meta' => false,
                    'media' => '(max-width: 767px)',
                ],
                'video' => [
                    // 'max' => 4096,
                    // 'show' => false,
                ],
            ],
//            'meta' =>  [
//                [
//                    'label' => 'tipo',
//                    'name' => 'type',
//                    'options' => [
//                        [
//                            'value' => '',
//                            'label' => '-',
//                        ],
//                        [
//                            'value' => 'Plantas Baixas',
//                            'label' => 'Plantas Baixas',
//                        ],
//                        [
//                            'value' => 'Implantações',
//                            'label' => 'Implantações',
//                        ]
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
//            ]
        ],
    ],
];
