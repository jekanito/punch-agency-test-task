<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Dashboard\TaskController;

//Route::middleware('auth:web')->group( function () {
    Route::get('/', [TaskController::class, 'index'])->name('home');
//});

Route::get('/', [TaskController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
