<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;

Route::get('/', [BlogController::class, 'returnBlogList'])->name('homepage');

Route::get('/login', [AdminController::class, 'returnLoginPage'])->name('loginPage');

Route::post('/login', [AdminController::class, 'login'])->name('login');

Route::get('/logout', [AdminController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard')->middleware('auth');

Route::get('/create-article', [BlogController::class, 'createArticle'])->name('create-article')->middleware('auth');

Route::post('/create-article', [BlogController::class, 'storeArticle'])->name('create-article')->middleware('auth');

Route::get('/edit-article/{id}', [BlogController::class, 'editArticle'])->name('edit-article')->middleware('auth');

Route::patch('/update-article/{id}', [BlogController::class, 'updateArticle'])->name('update-article')->middleware('auth');
