<?php

use Agenciafmd\Banners\Policies\BannerPolicy;

return [
    [
        'name' => config('admix-banners.name'),
        'policy' => BannerPolicy::class,
        'abilities' => [
            [
                'name' => 'View',
                'method' => 'view',
            ],
            [
                'name' => 'Create',
                'method' => 'create',
            ],
            [
                'name' => 'Update',
                'method' => 'update',
            ],
            [
                'name' => 'Delete',
                'method' => 'delete',
            ],
            [
                'name' => 'Restore',
                'method' => 'restore',
            ],
        ],
        'sort' => 100,
    ],
];
