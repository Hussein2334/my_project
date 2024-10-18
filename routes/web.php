<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResetPasswordController;

// Redirect the root URL to posts
Route::redirect('/', 'posts');

// Public resource routes for PostController (index and show methods are accessible publicly)
Route::resource('posts', PostController::class)->only(['index', 'show']);

// Route for user-specific posts
Route::get('/{user}/posts', [DashboardController::class, 'userPosts'])->name('posts.user');

// Routes protected by 'auth' middleware
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->middleware('verified')
        ->name('dashboard');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    // Email Verification Routes
    Route::get('/email/verify', [AuthController::class, 'verifyNotice'])
        ->name('verification.notice');

    Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])
        ->middleware('signed')
        ->name('verification.verify');

    // Resend verification email route
    Route::post('/email/verification-notification', [AuthController::class, 'verifyHandler'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    // Protected routes for creating, editing, updating, and deleting posts
    Route::resource('posts', PostController::class)->except(['index', 'show']);
});

// Routes for guests only (e.g., register and login)
Route::middleware('guest')->group(function () {
    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Forgot password and password reset routes
    Route::get('/forgot-password', [ResetPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('/forgot-password', [ResetPasswordController::class, 'passwordEmail']);
    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'passwordReset'])->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'passwordUpdate'])->name('password.update');
});
