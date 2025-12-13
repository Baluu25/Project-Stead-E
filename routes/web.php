<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Splash Screen (First thing users see)
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Redirect root to splash screen
Route::get('/', function () {
    return redirect()->route('welcome');
});

// Main Home Page (after splash)
Route::get('/home', function () {
    return view('index');
})->name('home');

// Alternative route for main page
Route::get('/index', function () {
    return view('index');
});

// Login Routes
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Register Routes
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// Forgot Password
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

// Registration Success
Route::get('/registration-success', function () {
    if (!session()->has('user_data')) {
        return redirect()->route('register');
    }
    return view('auth.registration-success', ['userData' => session('user_data')]);
})->name('registration.success');