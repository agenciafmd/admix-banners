<?php

namespace Agenciafmd\Banners\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        '\Agenciafmd\Banners\Banner' => '\Agenciafmd\Banners\Policies\BannerPolicy',
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
