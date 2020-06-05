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

## Uso

O componente utilizado para renderizar o banner, é o `\Agenciafmd\Banners\ViewComponents\BannerComponent::class`

A chamada feita é:

```blade
@render(\Agenciafmd\Banners\ViewComponents\BannerComponent::class, [
    ...
])
```

Os valores padrões são:

```
$qty = 4, // quantidade de itens que vamos mostrar
$location = null, // zona do banner
$rand = false,  // mostra os banners de forma aleatoria
$template = 'agenciafmd/banners::frontend.default' //template utilizado para renderização
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

Para mais de um local, adicione mais um item no `locations` 

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
    'locations' => [
        'home' => [
            'name' => 'Home',
            'html' => true,
            'meta' => [
                [
                    'label' => 'tipo',
                    'name' => 'type',
                    'options' => [
                        'Plantas Baixas',
                        'Implantações',
                    ],
                ],
                [
                    'label' => 'título',
                    'name' => 'title',
                ],
                [
                    'label' => 'subtítulo',
                    'name' => 'subtitle',
                ],
            ],
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