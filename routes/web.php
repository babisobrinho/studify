<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackController;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::controller(TrackController::class)->prefix('{username}/tracks')->name('tracks.')->group(function () {
        Route::get('/', 'index')->name('index'); // /{username}/tracks
        Route::get('/create', 'create')->name('create'); // /{username}/tracks/create
        Route::post('/{userId}/{id}/store', 'store')->name('store');
        Route::get('/{id}', 'show')->name('show'); // /{username}/tracks/{id}
        Route::patch('/{id}/update', 'update')->name('update');
        Route::delete('/{id}/destroy', 'destroy')->name('destroy');
    });
});