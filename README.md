## F&MD - Banners

![Área Administrativa](https://github.com/agenciafmd/admix-banners/raw/master/docs/screenshot.png "Área Administrativa")

[![Downloads](https://img.shields.io/packagist/dt/agenciafmd/admix-banners.svg?style=flat-square)](https://packagist.org/packages/agenciafmd/admix-banners)
[![Licença](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

- Banners responsivos descomplicados

## Instalação

```bash
composer require agenciafmd/admix-banners:v11.x-dev
```

Execute a migração

```bash
php artisan migrate
```

Para uma customização mais forte, execute:

```bash
php artisan vendor:publish --tag=admix-banners:seeders
```

**Não esqueça**

- de adicionar o `BannersTableSeeder::class` em `database/seeders/DatabaseSeeder.php`
- corrigir o namespace `Agenciafmd\Banners\Database\Seeders` para `Database\Seeders`
- de executar o `composer dumpautoload`

## Uso


## Configurações

Caso seja necessário alguma modificação, publique o arquivo de config com o comando:

```bash
php artisan vendor:publish --tag=admix-banners:configs
```

Ex. Para adicionar uma nova localização além de `home`, adicione um novo item ao array `locations`, como em: `'home-destaque' => [...]`:

```php
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
                        // 'aspectRatio' => round(3600 / 1700, 2),
                    ],
                    'show_meta' => false,
                    'media' => '(min-width: 1400px)',
                ],
                'notebook' => [
                    'max' => 2048,
                    'max_width' => 2080,
                    'max_height' => 1080,
                    'crop_config' => [
                        // 'aspectRatio' => round(2160 / 1660, 2),
                    ],
                    'show_meta' => false,
                    'media' => '(min-width: 768px)',
                ],
                'mobile' => [
                    'max' => 2048,
                    'max_width' => 1360,
                    'max_height' => 2380,
                    'crop_config' => [
                        // 'aspectRatio' => round(1360 / 2380, 2),
                    ],
                    'show_meta' => false,
                    'media' => '(max-width: 767px)',
                ],
                'video' => [
                    // 'max' => 4096,
                    // 'show' => true,
                ],
            ],
        ],
        'home-destaque' => [...],
    ],
];
```