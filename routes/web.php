<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoomCategoryController;
use App\Http\Controllers\RoomCheckerController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

Route::get("/", function () {return redirect('/dashboard');});

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
    Route::get("/", DashboardController::class)->name('dashboard');
    Route::resource("roomCategories", RoomCategoryController::class);
    Route::resource("roomCheckers", RoomCheckerController::class);
    Route::get('/roomCheckers/create/{room_id}', [RoomCheckerController::class, 'create'])->name('roomCheckers.create');
    Route::get('/roomCheckers/detail/{room_id}', [RoomCheckerController::class, 'detail'])->name('roomCheckers.detail');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('reports.export');
    Route::resource("rooms", RoomController::class);
    Route::get('/rooms/qrcode/download/{file}/{room_id}', [RoomController::class, 'download'])->name('rooms.download');
    Route::resource("reports", ReportController::class);
    Route::resource("admins", AdminController::class);
    Route::get("admins/{admin}/json", [AdminController::class, 'showJSON']);
    Route::resource("staffs", StaffController::class);

    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');

});
Route::middleware('auth')->group(function() {
    Route::post('/auth/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::fallback(function() {
    return view("errors.404");
});
