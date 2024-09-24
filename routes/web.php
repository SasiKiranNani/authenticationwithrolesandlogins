<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\GoogleController;
use App\Http\Controllers\auth\FacebookController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/user/dashboard', function () {
        return view('dashboard');
    })->name('user-dashboard');
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('admin-dashboard');
    Route::get('/index', function () {
        return view('index');})->name('index');
        
});


// Google Auth Routes
Route::get('auth/google', [GoogleController::class, 'googlepage'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'googlecallback'])->name('googlecallback');

// Facebook Auth Routes
Route::get('auth/facebook', [FacebookController::class, 'facebookpage'])->name('auth.facebook');
Route::get('auth/facebook/callback', [FacebookController::class, 'facebookcallback'])->name('facebookcallback');

require __DIR__.'/socialite.php';