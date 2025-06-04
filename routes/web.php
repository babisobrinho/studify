<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::middleware('guest')->group(function () {
    Route::controller(LandingController::class)->group(function () {
        Route::get('/', 'index')->name('landing');
        Route::get('/about', 'about')->name('about');
    });
});

Route::middleware('auth')->group(function () {
    Route::controller(HomeController::class)->group(function () {
        Route::get('/home', 'index')->name('index');
    });
    Route::controller(TrackController::class)->prefix('{username}/tracks')->name('tracks.')->group(function () {
        //
    });
});
