<?php

namespace Agenciafmd\Banners\Providers;

use Agenciafmd\Banners\Http\Components\Banner;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadBladeComponents();

        $this->loadBladeDirectives();

        $this->loadBladeComposers();

        $this->setMenu();

        $this->loadViews();

        $this->loadTranslations();

        $this->publish();
    }

    public function register(): void
    {
        //
    }

    protected function loadBladeComponents(): void
    {
        Blade::component('banner', Banner::class);
    }

    protected function loadBladeComposers(): void
    {
        //
    }

    protected function loadBladeDirectives(): void
    {
        //
    }

    protected function setMenu(): void
    {
        $this->app->make('admix-menu')
            ->push((object)[
                'view' => 'agenciafmd/banners::partials.menus.item',
                'ord' => config('admix-banners.sort', 1),
            ]);
    }

    protected function loadViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'agenciafmd/banners');
    }

    protected function loadTranslations(): void
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'agenciafmd/banners');
    }

    protected function publish(): void
    {
        $this->publishes([
            __DIR__ . '/../resources/views/frontend' => base_path('resources/views/vendor/agenciafmd/banners/frontend'),
        ], 'admix-banners:views');
    }
}
