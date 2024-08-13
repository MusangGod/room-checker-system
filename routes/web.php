<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

// Mengelompokkan Routes yang menggunakan AuthController
Route::controller(AuthController::class)->middleware('guest')->prefix('auth')->group(function() {
    // Route untuk view login
    Route::get("/login", "loginView")->name("login");
    // Route untuk proses login
    Route::post("/login", "login")->name('login.post');

    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('forgot-password', 'forgotPassword')->name('forgot-password');
        Route::post('forgot-password', 'forgotPasswordForm')->name('forgot-password.post');
        Route::get('reset-password/{token}', 'resetPassword')->name('reset-password');
        Route::post('reset-password', 'resetPasswordForm')->name('reset-password.post');
    });
});

// Mengelompokkan Routes yang memerlukan autentikasi menggunakan middleware auth
Route::middleware(["auth"])->prefix('/dashboard')->group(function() {
    // Route untuk dashboard
    Route::get("/", DashboardController::class)->name('dashboard');
    // Route untuk modul post
    // Menggunakan resource untuk CRUD
    Route::resource("posts", PostController::class);
    // Route untuk modul tag
    // Menggunakan resource untuk CRUD
    Route::resource("tags", TagController::class);
    // Route untuk modul admin
    // Menggunakan resource untuk CRUD
    Route::resource("admins", AdminController::class);
    Route::get("admins/{admin}/json", [AdminController::class, 'showJSON']);
    // Route untuk modul staff
    // Menggunakan resource untuk CRUD
    Route::resource("staffs", StaffController::class);

});
Route::middleware('auth')->group(function() {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::fallback(function() {
    return view("errors.404");
});