<?php

return [
    'banner' => [
        'home' => [
            'desktop' => [
                'label' => 'desktop',
                'sources' => [
                    [
                        'conversion' => 'desktop',
                        'media' => '(min-width: 1600px)',
                        'width' => 1920 * 2,
                        'height' => 850 * 2,
                        'optimize' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? false : true,
                        'quality' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? 75 : 100,
                    ],
                ],
            ],
            'notebook' => [
                'label' => 'notebook',
                'sources' => [
                    [
                        'conversion' => 'notebook',
                        'media' => '(min-width: 1024px)',
                        'width' => 1366 * 2,
                        'height' => 605 * 2,
                        'optimize' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? false : true,
                        'quality' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? 75 : 100,
                    ],
                ],
            ],
            'mobile' => [
                'label' => 'mobile',
                'sources' => [
                    [
                        'conversion' => 'mobile',
                        'media' => '(max-width: 1023px)',
                        'width' => 375 * 2,
                        'height' => 600 * 2,
                        'optimize' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? false : true,
                        'quality' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? 75 : 100,
                    ],
                ],
            ],
        ],
//        'interna' => [
//            'desktop' => [
//                'label' => 'desktop',
//                'sources' => [
//                    [
//                        'conversion' => 'desktop',
//                        'media' => '(min-width: 1600px)',
//                        'width' => 1920 * 2,
//                        'height' => 850 * 2,
//                        'optimize' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? false : true,
//                        'quality' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? 75 : 100,
//                    ],
//                ],
//            ],
//            'notebook' => [
//                'label' => 'notebook',
//                'sources' => [
//                    [
//                        'conversion' => 'notebook',
//                        'media' => '(min-width: 1024px)',
//                        'width' => 1366 * 2,
//                        'height' => 605 * 2,
//                        'optimize' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? false : true,
//                        'quality' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? 75 : 100,
//                    ],
//                ],
//            ],
//            'mobile' => [
//                'label' => 'mobile',
//                'sources' => [
//                    [
//                        'conversion' => 'mobile',
//                        'media' => '(max-width: 1023px)',
//                        'width' => 375 * 2,
//                        'height' => 600 * 2,
//                        'optimize' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? false : true,
//                        'quality' => ((env('APP_ENV') === 'local') || (env('APP_ENV') === 'testing')) ? 75 : 100,
//                    ],
//                ],
//            ],
//        ],
    ],
];
