<?php

use App\Http\Controllers\{DashboardController, WelcomeController, ProfileController, AdminController, FaqController, UserController, PostController, PromptController, TagController};
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::get('/faq', [WelcomeController::class, 'faq'])->name('faq');

Route::middleware('auth')->group(function () {

    Route::prefix('/profile')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    Route::middleware('verified')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


        Route::prefix('/posts')->name('posts.')->group(function () {
            Route::post('/', [PostController::class, 'store'])->name('store')->middleware('throttle:2,1');
            Route::get('/create', [PostController::class, 'create'])->name('create');
            Route::get('/starred', [PostController::class, 'starredPosts'])->name('starred');
            Route::get('/{post}', [PostController::class, 'show'])->name('show');
            Route::patch('/{post}', [PostController::class, 'update'])->name('update');
            Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
            Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
            Route::post('/{post}/like', [PostController::class, 'like'])->name('like');
            Route::delete('/{post}/like', [PostController::class, 'unlike'])->name('unlike');
            Route::post('/{post}/star', [PostController::class, 'star'])->name('star');
            Route::delete('/{post}/star', [PostController::class, 'unstar'])->name('unstar');
            Route::post('/{post}/comment', [PostController::class, 'comment'])->name('comment')->middleware('throttle:10,1');
            Route::delete('/{post}/comment/{comment}', [PostController::class, 'uncomment'])->name('uncomment');
        });

        Route::prefix('/prompts')->name('prompts.')->group(function () {
            Route::get('/', [PromptController::class, 'index'])->name('index');
            Route::post('/free', [PromptController::class, 'storeFree'])->name('store.free')->middleware('throttle:2,1');
            Route::post('/paid', [PromptController::class, 'storePaid'])->name('store.paid')->middleware('throttle:5,1');
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

        Route::prefix('/faqs')->name('faqs.')->group(function () {
            Route::get('/', [FaqController::class, 'index'])->name('index');
            Route::post('/', [FaqController::class, 'store'])->name('store');
            Route::patch('/{faq}', [FaqController::class, 'update'])->name('update');
            Route::delete('/{faq}', [FaqController::class, 'destroy'])->name('destroy');
        });
    });
});

require __DIR__ . '/auth.php';
