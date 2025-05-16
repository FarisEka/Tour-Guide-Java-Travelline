<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Guide\DashboardController as GuideDashboardController;

//
// TRAVELLER ROUTES (Non-login user)
//
Route::get('/', function () {
    return view('traveller.home');
})->name('home');

Route::get('/booking', function () {
    return view('traveller.booking');
})->name('booking');

Route::get('/search', function () {
    return view('traveller.search');
})->name('search');


//
// TOUR GUIDE ROUTES (Logged-in user)
//
Route::middleware(['auth', 'verified'])->prefix('guide')->group(function () {
    Route::get('/dashboard', [GuideDashboardController::class, 'index'])->name('guide.dashboard');
});

//
// ADMIN ROUTES
//
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

//
// AUTHENTICATED USER PROFILE
//
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//
// LARAVEL BAWAAN AUTH
//
require __DIR__.'/auth.php';
