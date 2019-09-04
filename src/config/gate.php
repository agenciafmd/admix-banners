<?php

return [
    [
        'name' => 'Banners',
        'policy' => '\Agenciafmd\Banners\Policies\BannerPolicy',
        'abilities' => [
            [
                'name' => 'visualizar',
                'method' => 'view',
            ],
            [
                'name' => 'criar',
                'method' => 'create',
            ],
            [
                'name' => 'atualizar',
                'method' => 'update',
            ],
            [
                'name' => 'deletar',
                'method' => 'delete',
            ],
            [
                'name' => 'restarurar',
                'method' => 'restore',
            ],
        ],
        'sort' => 10
    ],
];
