<?php

namespace Agenciafmd\Banners\Providers;

use Agenciafmd\Banners\Models\Banner;
use Agenciafmd\Banners\Policies\BannerPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Banner::class => BannerPolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
