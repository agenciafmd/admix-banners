<?php

namespace Agenciafmd\Banners\Providers;

use Agenciafmd\Banners\Livewire\Pages;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class LivewireServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Livewire::component('agenciafmd.banners.livewire.pages.banner.index', Pages\Banner\Index::class);
        Livewire::component('agenciafmd.banners.livewire.pages.banner.component', Pages\Banner\Component::class);
    }

    public function register(): void
    {
        //
    }
}
