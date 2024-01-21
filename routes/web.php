<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\users\UserController;

// Register
Route::get('/register', [UserController::class, 'register'])->name('register')->middleware('guest');
Route::post('/create-user', [UserController::class,'create_user'])->name('create.user');

// Login
Route::get('/login', [UserController::class,'login'])->name('login')->middleware('guest');
Route::post('/user/authenticate', [UserController::class,'authenticate'])->name('authenticate');

// Logut
Route::post('/logout', [UserController::class,'logout'])->name('logout')->middleware('auth');

// Edit user
Route::get('/user/{user}/edit', [UserController::class,'edit'])->name('edit.user')->middleware('auth');
Route::post('/users', [UserController::class,'update'])->name('update.user')->middleware('auth');

// Default redirect to Posts
Route::get('/', [IndexController::class,'index'])->name('home')->middleware('auth');

// Posts
Route::resource('/posts', PostController::class)->middleware('auth');

Route::prefix('/user')->group(function () {
    Route::get('/dashboard', [UserController::class,'index'])->name('dashboard')->middleware('auth');
})->middleware('auth');