<?php

use App\Http\Controllers\{DashboardController, WelcomeController, ProfileController, AdminController, UserController, PostController, PromptController, TagController};
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
            Route::post('/', [PostController::class, 'store'])->name('store')->middleware('throttle:2,1');
            Route::get('/{post}', [PostController::class, 'show'])->name('show');
            Route::patch('/{post}', [PostController::class, 'update'])->name('update');
            Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
            Route::post('/{post}/like', [PostController::class, 'like'])->name('like');
            Route::delete('/{post}/like', [PostController::class, 'unlike'])->name('unlike');
            Route::post('/{post}/star', [PostController::class, 'star'])->name('star');
            Route::delete('/{post}/star', [PostController::class, 'unstar'])->name('unstar');
            Route::post('/{post}/comment', [PostController::class, 'comment'])->name('comment')->middleware('throttle:10,1');
            Route::delete('/{post}/comment/{comment}', [PostController::class, 'uncomment'])->name('uncomment');
            Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
        });

        Route::prefix('/prompts')->name('prompts.')->group(function () {
            Route::get('/', [PromptController::class, 'index'])->name('index');
            Route::post('/free', [PromptController::class, 'storeFree'])->name('store.free');
            Route::post('/paid', [PromptController::class, 'storePaid'])->name('store.paid');
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
        });

        Route::prefix('/tags')->name('tags.')->group(function () {
            Route::get('/', [TagController::class, 'index'])->name('index');
            Route::post('/', [TagController::class, 'store'])->name('store');
            Route::patch('/{post}', [TagController::class, 'update'])->name('update');
            Route::delete('/{post}', [TagController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('/prompts')->name('prompts.')->group(function () {
            Route::get('/', [PromptController::class, 'adminIndex'])->name('index');
        });
    });
});

require __DIR__ . '/auth.php';
