<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/{username}', [App\Http\Controllers\UserController::class, 'profile'])->name('user.profile');