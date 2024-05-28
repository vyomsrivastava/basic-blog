<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AdminController;

Route::get('/', [BlogController::class, 'returnBlogList'])->name('homepage');

Route::get('/login', [AdminController::class, 'returnLoginPage'])->name('loginPage');