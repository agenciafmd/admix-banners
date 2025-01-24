<?php

namespace Agenciafmd\Banners\Observers;

use Agenciafmd\Banners\Models\Banner;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Http;

class BannerObserver
{
    public function saved(Banner $model): void
    {
        if (!app()->runningInConsole()) {
            try {
                dispatch(function () {
                    Artisan::call('page-cache:clear', [
                        'slug' => 'pc__index__pc',
                    ]);

                    Http::get(url('/'));
                })
                    ->delay(now()->addSeconds(5))
                    ->onQueue('low');
            } catch (\Exception $exception) {
                // não tem problema
            }
        }
    }
}