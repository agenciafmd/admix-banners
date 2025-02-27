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
- de executar o `composer dumpautoload`

## Uso


## Configurações

Caso seja necessário alguma modificação, publique o arquivo de config com o comando:

```bash
php artisan vendor:publish --tag=admix-banners:configs
```

Ex.

```php
<?php

return [
    'name' => 'Banners',
    'icon' => 'device-desktop',
    'sort' => 100,
];
```