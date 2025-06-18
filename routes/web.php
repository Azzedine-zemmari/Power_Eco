<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;

// All routes that don't match the API routes will be handled by the SPA
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');

Route::get('/reset-password/{token}', function ($token) {
    return view('welcome');
})->name('password.reset');

Route::get('/', function () {
    return response()->file(public_path('login.vue'));
})->name('login');
