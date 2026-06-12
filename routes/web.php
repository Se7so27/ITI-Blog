<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Models\Comment;
use App\Models\Post;
use Inertia\Inertia;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth')->group(function () {
    Route::resource('posts', PostController::class);
    Route::patch('/posts/{id}/restore', [PostController::class, 'restore'])->name('posts.restore');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});

Route::middleware('can:is-admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Admin/Dashboard', [
            'postsCount'    => Post::withTrashed()->count(),
            'commentsCount' => Comment::count(),
        ]);
    })->name('dashboard');

    Route::get('/posts', function () {
        return Inertia::render('Admin/Posts/Index', [
            'posts' => Post::withTrashed()->with('user')->latest()->paginate(10),
        ]);
    })->name('posts.index');

    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

    Route::get('/comments', function () {
        return Inertia::render('Admin/Comments/Index', [
            'comments' => Comment::with('user', 'post')->latest()->paginate(10),
        ]);
    })->name('comments.index');

    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

Route::get('/auth/github', [SocialiteController::class, 'redirect'])->name('auth.github');
Route::get('/auth/github/callback', [SocialiteController::class, 'callback']);

require __DIR__ . '/auth.php';
