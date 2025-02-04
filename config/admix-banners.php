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
        ],
        'notebook' => [
            'max' => 2048,
            'max_width' => 2160,
            'max_height' => 1660,
        ],
        'mobile' => [
            'max' => 2048,
            'max_width' => 1360,
            'max_height' => 2380,
        ],
    ],
];
