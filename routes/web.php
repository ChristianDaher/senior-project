<?php

use App\Http\Controllers\{DashboardController, WelcomeController, ProfileController, AdminController};
use Illuminate\Support\Facades\Route;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('verified')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    });

    Route::middleware('can:admin')->group(function () {
        Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin-dashboard');
    });
});

require __DIR__ . '/auth.php';
