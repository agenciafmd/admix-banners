<?php

namespace Agenciafmd\Banners\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class BladeServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->bootBladeComponents();

        $this->bootBladeDirectives();

        $this->bootBladeComposers();

        $this->bootMenu();

        $this->bootViews();

        $this->bootPublish();
    }

    public function register(): void
    {
        //
    }

    private function bootBladeComponents(): void
    {
        Blade::componentNamespace('Agenciafmd\\Banners\\Http\\Components', 'admix-banners');
    }

    private function bootBladeComposers(): void
    {
        //
    }

    private function bootBladeDirectives(): void
    {
        //
    }

    private function bootMenu(): void
    {
        $this->app->make('admix-menu')
            ->push((object) [
                'component' => 'admix-banners::aside.banner',
                'ord' => config('admix-banners.sort'),
            ]);
    }

    private function bootViews(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'admix-banners');
    }

    private function bootPublish(): void
    {
        // $this->publishes([
        //     __DIR__ . '/../resources/views' => base_path('resources/views/vendor/agenciafmd/banners'),
        // ], 'admix-banners:views');
    }
}
