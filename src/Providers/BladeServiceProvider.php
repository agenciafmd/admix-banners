<?php

namespace Agenciafmd\Banners\Providers;

use Agenciafmd\Banners\Http\Components\Banner;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class BladeServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadBladeComponents();

        $this->loadBladeDirectives();

        $this->loadBladeComposers();

        $this->setMenu();

        $this->loadViews();

        $this->loadTranslations();

        $this->publish();
    }

    public function register()
    {
        //
    }

    protected function loadBladeComponents()
    {
        Blade::component('banner', Banner::class);
    }

    protected function loadBladeComposers()
    {
        //
    }

    protected function loadBladeDirectives()
    {
        //
    }

    protected function setMenu()
    {
        $this->app->make('admix-menu')
            ->push((object)[
                'view' => 'agenciafmd/banners::partials.menus.item',
                'ord' => config('admix-banners.sort', 1),
            ]);
    }

    protected function loadViews()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'agenciafmd/banners');
    }

    protected function loadTranslations()
    {
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'agenciafmd/banners');
    }

    protected function publish()
    {
        $this->publishes([
            __DIR__ . '/../resources/views/frontend' => base_path('resources/views/vendor/agenciafmd/banners/frontend'),
        ], 'admix-banners:views');
    }
}
