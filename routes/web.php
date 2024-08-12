<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use Illuminate\Support\Facades\Route;

// Mengelompokkan Routes yang menggunakan AuthController
Route::controller(AuthController::class)->prefix('auth')->group(function() {
    // Route untuk view login
    Route::get("/login", "loginView")->name("login");
    // Route untuk proses login
    Route::post("/login", "login")->name('login.post');

    // Route untuk view pendaftaran (registrasi)
    Route::post("/register", "registerView")->name('register');
    // Route untuk proses pendaftaran (registrasi)
    Route::post("/register", "register")->name('register.post');
});

// Route untuk modul post (index, show)
// Menggunakan resource untuk CRUD kecuali operasi store, update, dan delete
Route::resource("posts", PostController::class)->except("store", "update", "delete");

// Route untuk modul tag (index, show)
// Menggunakan resource untuk CRUD kecuali operasi store, update, dan delete
Route::resource("tags", TagController::class)->except("store", "update", "delete");

// Mengelompokkan Routes yang memerlukan autentikasi menggunakan middleware auth
Route::middleware(["auth"])->group(function() {
    // Route untuk modul post (create, update, delete)
    // Menggunakan resource untuk CRUD kecuali operasi index dan show
    Route::resource("posts", PostController::class)->except("index", "show");
    // Route untuk mengupload gambar pada post
    Route::post("posts/{post}/upload-image", [PostController::class, 'uploadImage']);
    // Route untuk modul tag (create, update, delete)
    // Menggunakan resource untuk CRUD kecuali operasi index dan show
    Route::resource("tags", TagController::class)->except("index", "show");
});