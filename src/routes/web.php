<?php

use Agenciafmd\Banners\Http\Controllers\BannerController;
use Agenciafmd\Banners\Models\Banner;

Route::get('banners', [BannerController::class, 'index'])
    ->name('admix.banners.index')
    ->middleware('can:view,' . Banner::class);
Route::get('banners/trash', [BannerController::class, 'index'])
    ->name('admix.banners.trash')
    ->middleware('can:restore,' . Banner::class);
Route::get('banners/{location?}/create', [BannerController::class, 'create'])
    ->name('admix.banners.create')
    ->middleware('can:create,' . Banner::class);
Route::post('banners', [BannerController::class, 'store'])
    ->name('admix.banners.store')
    ->middleware('can:create,' . Banner::class);
Route::get('banners/{banner}/edit', [BannerController::class, 'edit'])
    ->name('admix.banners.edit')
    ->middleware('can:update,' . Banner::class);
Route::put('banners/{banner}', [BannerController::class, 'update'])
    ->name('admix.banners.update')
    ->middleware('can:update,' . Banner::class);
Route::delete('banners/destroy/{banner}', [BannerController::class, 'destroy'])
    ->name('admix.banners.destroy')
    ->middleware('can:delete,' . Banner::class);
Route::post('banners/{id}/restore', [BannerController::class, 'restore'])
    ->name('admix.banners.restore')
    ->middleware('can:restore,' . Banner::class);
Route::post('banners/batchDestroy', [BannerController::class, 'batchDestroy'])
    ->name('admix.banners.batchDestroy')
    ->middleware('can:delete,' . Banner::class);
Route::post('banners/batchRestore', [BannerController::class, 'batchRestore'])
    ->name('admix.banners.batchRestore')
    ->middleware('can:restore,' . Banner::class);
