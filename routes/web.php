<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackController;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(TrackController::class)->prefix('tracks')->name('tracks.')->group(function () {
    //Route::get('/{username}', 'index')->name('index');
    Route::get('/', 'index')->name('index');
    Route::get('/create', 'create')->name('create');
    //Route::post('/{username}/{id}/store', 'store')->name('store');
    Route::get('/show', 'show')->name('show');
    Route::get('/edit', 'edit')->name('edit');
    //Route::patch('/{username}/{id}/update', 'update')->name('update');
    //Route::delete('/{username}/{id}/destroy', 'destroy')->name('destroy');
});
