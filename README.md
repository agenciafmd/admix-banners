## F&MD - Banners

[![Downloads](https://img.shields.io/packagist/dt/agenciafmd/admix-banners.svg?style=flat-square)](https://packagist.org/packages/agenciafmd/admix-banners)
[![Licença](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

- Banners responsivos descomplicados

## Instalação

```shell script
composer require agenciafmd/admix-banners:dev-master
```

Execute a migração

```shell script
php artisan migrate
```

## Seed

Para utlizar o seed do pacote, faça a publicação com o comando abaixo:

```shell script
php artisan vendor:publish --provider="Agenciafmd\Banners\Providers\BannerServiceProvider" --tag="seed" && composer dumpautoload
```

Faça a troca dos banners em `database/faker/banners` para que o projeto fique belo

**Não esqueça** de adicionar o `BannersTableSeeder::class` em `database/seeds/DatabaseSeeder.php`

## Configurações

Caso seja necessário alguma modificação, publique o arquivo de config com o comando:

```shell script
php artisan vendor:publish --provider="Agenciafmd\Banners\Providers\BannerServiceProvider" --tag="config"
```

Para mais de um local, adicione mais um item no `places` 

Para mais um formato, adicione mais um item no `items`

Ex.
```php
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
                ...
                'mobile' => [
                    'width' => 375,
                    'height' => 600,
                    'quality' => 95,
                    'crop' => true,
                ],
            ],
        ],
        ...
    ],
];

```