## F&MD - Banners

![Área Administrativa](https://github.com/agenciafmd/admix-banners/raw/master/docs/screenshot.png "Área Administrativa")

[![Downloads](https://img.shields.io/packagist/dt/agenciafmd/admix-banners.svg?style=flat-square)](https://packagist.org/packages/agenciafmd/admix-banners)
[![Licença](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

- Banners responsivos descomplicados

## Instalação

```bash
composer require agenciafmd/admix-banners:dev-master
```

Execute a migração

```bash
php artisan migrate
```

O jeito mais prático para customizar os banners, é publicar: 

```
config/upload-configs.php
database/faker/banners/*
```

Para isso, usaremos.

```bash
php artisan vendor:publish --tag=admix-banners:minimal
```

Para uma customização mais forte, execute:

```bash
php artisan vendor:publish --tag=admix-banners:seeders
```

**Não esqueça**

- de trocar os banners em `database/faker/banners` para que o projeto fique belo
- de adicionar o `BannersTableSeeder::class` em `database/seeders/DatabaseSeeder.php`
- de executar o `composer dumpautoload`

## Uso

Chame o componente `<x-banner />`

A configuração padrão é

```html

<x-banner quantity=4
          location='home'
          :random=false
          template='agenciafmd/banners::components.home'
/>
```

Se for preciso alguma customização da listagem dos banners, crie o blade do component no namespace do frontend

## Configurações

Caso seja necessário alguma modificação, publique o arquivo de config com o comando:

```bash
php artisan vendor:publish --tag=admix-banners:configs
```

Para mais de um local, adicione mais um item no `locations` em `admix-banners.php` e configure os tamanhos
em `upload-configs.php`

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
        ],
        ...
    ],
];
```

Para mais um formato, adicione mais um item no `banner`

```php
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
                    ],
                ],
            ],
        ],
        ...
    ],
];
```
