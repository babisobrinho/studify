<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TrackController;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::controller(TrackController::class)->prefix('{username}/tracks')->name('tracks.')->group(function () {
        Route::get('/', 'index')->name('index'); // /{username}/tracks
        Route::get('/create', 'create')->name('create'); // /{username}/tracks/create
        Route::post('/', 'store')->name('store'); // /{username}/tracks (POST)
        Route::get('/{id}', 'show')->name('show'); // /{username}/tracks/{id}
        Route::get('/{id}/edit', 'edit')->name('edit'); // /{username}/tracks/{id}/edit
        Route::patch('/{id}', 'update')->name('update'); // /{username}/tracks/{id} (PATCH)
        Route::delete('/{id}', 'destroy')->name('destroy'); // /{username}/tracks/{id} (DELETE)
    });
});
