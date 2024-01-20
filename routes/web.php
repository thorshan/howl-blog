<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\users\UserController;

// Register
Route::get('/register', [UserController::class, 'register'])->name('register')->middleware('guest');
Route::post('/users', [UserController::class,'create_user'])->name('user.create');
// Login
Route::get('/login', [UserController::class,'login'])->name('login')->middleware('guest');
Route::post('/user/authenticate', [UserController::class,'authenticate'])->name('authenticate');
// Logut
Route::post('/logout', [UserController::class,'logout'])->name('logout')->middleware('auth');

Route::get('/', [IndexController::class,'index'])->name('home')->middleware('auth');

Route::prefix('/user')->group(function () {
    Route::get('/dashboard', [UserController::class,'index'])->name('dashboard')->middleware('auth');
    Route::resource('/posts', PostController::class)->middleware('auth');
})->middleware('auth');