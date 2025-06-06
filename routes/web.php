<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

    Route::get('/{username}', [App\Http\Controllers\UserController::class, 'profile'])->name('users.profile');
    
    Route::controller(TrackController::class)->name('tracks.')->group(function () {
        // Community routes
        Route::prefix('{username}/tracks')->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/', 'store')->name('store');
            Route::get('/{id}', 'show')->name('show');
            Route::get('/{id}/edit', 'edit')->name('edit');
            Route::patch('/{id}', 'update')->name('update');
            Route::delete('/{id}', 'destroy')->name('destroy');
            
            // Rating route
            Route::post('/{track}/rate', 'rate')->name('rate');
            Route::post('/{track}/comment', 'comment')->name('comment');
        });
    });
});
