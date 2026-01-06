<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Splash Screen
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// Redirect root to splash screen
Route::get('/', function () {
    return redirect()->route('welcome');
});

// Main Home Page
Route::get('/home', function () {
    return view('index');
})->name('home');

// Alternative route for main page
Route::get('/index', function () {
    return view('index');
});

/// Registration
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Protected Dashboard
Route::get('/dashboard', function () {
    return view('dashboard'); 
});