<?php

use App\Http\Controllers\{DashboardController, WelcomeController, ProfileController, AdminController, UserController, PostController, PromptController};
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('verified')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::middleware('can:admin')->prefix('/admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
        Route::resources([
            'users' => UserController::class,
            'posts' => PostController::class,
            'prompts' => PromptController::class
        ]);
    });
});

require __DIR__ . '/auth.php';
