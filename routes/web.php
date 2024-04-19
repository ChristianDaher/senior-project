<?php

use App\Http\Controllers\{DashboardController, WelcomeController, ProfileController, AdminController, UserController, PostController, PromptController};
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {

    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    Route::middleware('verified')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::prefix('/posts')->name('posts.')->group(function () {
            Route::get('/create', [PostController::class, 'create'])->name('create');
            Route::post('/', [PostController::class, 'store'])->name('store');
            Route::get('/{post}', [PostController::class, 'show'])->name('show');
            Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
            Route::patch('/{post}', [PostController::class, 'update'])->name('update');
            Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
        });
    });

    Route::middleware('can:admin')->prefix('/admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

        Route::prefix('/users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::patch('/{user}', [UserController::class, 'update'])->name('update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('/posts')->name('posts.')->group(function () {
            Route::get('/', [PostController::class, 'adminIndex'])->name('index');
            Route::patch('/{post}', [PostController::class, 'adminUpdate'])->name('update');
            Route::delete('/{post}', [PostController::class, 'adminDestroy'])->name('destroy');
        });

        Route::resource('prompts', PromptController::class);
    });
});

require __DIR__ . '/auth.php';
