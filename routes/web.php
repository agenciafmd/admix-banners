<?php

use Agenciafmd\Banners\Livewire\Pages;
use Illuminate\Support\Facades\Route;

Route::get('/banners', Pages\Banner\Index::class)
    ->name('admix.banners.index');
Route::get('/banners/trash', Pages\Banner\Index::class)
    ->name('admix.banners.trash');
Route::get('/banners/{location?}/create', Pages\Banner\Component::class)
    ->name('admix.banners.create');
Route::get('/banners/{banner}/edit', Pages\Banner\Component::class)
    ->name('admix.banners.edit');
