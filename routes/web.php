<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;

Auth::routes();

Route::middleware('guest')->group(function () {
    Route::controller(LandingController::class)->group(function () {
        Route::get('/', 'index')->name('landing');
        Route::get('/about', 'about')->name('about');
    });
});

Route::middleware('auth')->group(function () {
    //
});