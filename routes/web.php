<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminTrackController;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('tracks', AdminTrackController::class);

        Route::prefix('tracks')->name('tracks.')->group(function () {
            Route::get('/', [AdminTrackController::class, 'index'])->name('index');
            Route::get('/create', [AdminTrackController::class, 'create'])->name('create');
            // ... outras rotas adicionais aqui
        });
    });
});
