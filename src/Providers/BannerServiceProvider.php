<?php

namespace Agenciafmd\Banners\Providers;

use Agenciafmd\Banners\Models\Banner;
use Agenciafmd\Banners\Observers\BannerObserver;
use Illuminate\Support\ServiceProvider;

class BannerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->providers();

        $this->setObservers();

        $this->setSearch();

        $this->loadMigrations();

        $this->publish();
    }

    public function register(): void
    {
        $this->loadConfigs();
    }

    protected function providers(): void
    {
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(BladeServiceProvider::class);
        $this->app->register(RouteServiceProvider::class);
    }

    protected function setSearch(): void
    {
        $this->app->make('admix-search')
            ->registerModel(Banner::class, 'name');
    }

    protected function setObservers(): void
    {
        Banner::observe(BannerObserver::class);
    }

    protected function loadMigrations(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    protected function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../Database/Faker' => base_path('database/faker'),
            __DIR__ . '/../config/upload-configs.php' => base_path('config/upload-configs.php'),
        ], 'admix-banners:minimal');

        $this->publishes([
            __DIR__ . '/../config/admix-banners.php' => base_path('config/admix-banners.php'),
            __DIR__ . '/../config/upload-configs.php' => base_path('config/upload-configs.php'),
        ], 'admix-banners:configs');

        $this->publishes([
            __DIR__ . '/../Database/Factories/BannerFactory.php' => base_path('database/factories/BannerFactory.php'),
            __DIR__ . '/../Database/Faker' => base_path('database/faker'),
            __DIR__ . '/../Database/Seeders/BannersTableSeeder.php' => base_path('database/seeders/BannersTableSeeder.php'),
        ], 'admix-banners:seeders');
    }

    protected function loadConfigs(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/admix-banners.php', 'admix-banners');
        $this->mergeConfigFrom(__DIR__ . '/../config/upload-configs.php', 'upload-configs');
        $this->mergeConfigFrom(__DIR__ . '/../config/gate.php', 'gate');
        $this->mergeConfigFrom(__DIR__ . '/../config/audit-alias.php', 'audit-alias');
    }
}
