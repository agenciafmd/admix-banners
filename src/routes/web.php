<?php

/*
|--------------------------------------------------------------------------
| ADMIX Routes
|--------------------------------------------------------------------------
*/

Route::prefix(config('admix.url') . '/banners')
    ->name('admix.banners.')
    ->middleware(['auth:admix-web'])
    ->group(function () {
        Route::get('', 'BannerController@index')
            ->name('index')
            ->middleware('can:view,\Agenciafmd\Banners\Banner');
        Route::get('trash', 'BannerController@index')
            ->name('trash')
            ->middleware('can:restore,\Agenciafmd\Banners\Banner');
        Route::get('create/{location}', 'BannerController@create')
            ->name('create')
            ->middleware('can:create,\Agenciafmd\Banners\Banner');
        Route::post('', 'BannerController@store')
            ->name('store')
            ->middleware('can:create,\Agenciafmd\Banners\Banner');
        Route::get('{banner}/{location}', 'BannerController@show')
            ->name('show')
            ->middleware('can:view,\Agenciafmd\Banners\Banner');
        Route::get('{banner}/edit/{location}', 'BannerController@edit')
            ->name('edit')
            ->middleware('can:update,\Agenciafmd\Banners\Banner');
        Route::put('{banner}', 'BannerController@update')
            ->name('update')
            ->middleware('can:update,\Agenciafmd\Banners\Banner');
        Route::delete('destroy/{banner}', 'BannerController@destroy')
            ->name('destroy')
            ->middleware('can:delete,\Agenciafmd\Banners\Banner');
        Route::post('{id}/restore', 'BannerController@restore')
            ->name('restore')
            ->middleware('can:restore,\Agenciafmd\Banners\Banner');
        Route::post('batchDestroy', 'BannerController@batchDestroy')
            ->name('batchDestroy')
            ->middleware('can:delete,\Agenciafmd\Banners\Banner');
        Route::post('batchRestore', 'BannerController@batchRestore')
            ->name('batchRestore')
            ->middleware('can:restore,\Agenciafmd\Banners\Banner');
    });
