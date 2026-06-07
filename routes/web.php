<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('posts', PostController::class);
Route::patch('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');