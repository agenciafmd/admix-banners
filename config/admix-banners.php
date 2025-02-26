<?php

return [
    'name' => 'Banners',
    'icon' => 'device-desktop',
    'sort' => 110,
    'files' => [
        'desktop' => [
            'max' => 4096,
            'max_width' => 3600,
            'max_height' => 1700,
            'crop_config' => [
                //            'aspectRatio' => round(3600 / 1700, 2),
            ],
            'show_meta' => false,
        ],
        'notebook' => [
            'max' => 2048,
            'max_width' => 2160,
            'max_height' => 1660,
            'crop_config' => [
                //            'aspectRatio' => round(2160 / 1660, 2),
            ],
            'show_meta' => false,
        ],
        'mobile' => [
            'max' => 2048,
            'max_width' => 1360,
            'max_height' => 2380,
            'crop_config' => [
                //            'aspectRatio' => round(1360 / 2380, 2),
            ],
            'show_meta' => false,
        ],
    ],
];
