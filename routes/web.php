<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogController::class, 'returnBlogList'])->name('homepage');

Route::get('/login', [AdminController::class, 'returnLoginPage'])->name('loginPage');

Route::post('/login', [AdminController::class, 'login'])->name('login');

Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard')->middleware('auth');