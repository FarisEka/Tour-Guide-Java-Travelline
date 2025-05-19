<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TourGuideController as AdminTourGuideController;
use App\Http\Controllers\Guide\DashboardController as GuideDashboardController;


Route::get('/test-login-route', function () {
    return route('login');
});
//
// PUBLIC ROUTES (Untuk traveller, tanpa login)
//
Route::view('/', 'traveller.home')->name('home');
Route::view('/booking', 'traveller.booking')->name('booking');
Route::view('/search', 'traveller.search')->name('search');

//
// GUIDE ROUTES (Untuk tour guide setelah login)
//
Route::middleware(['auth', 'verified'])->prefix('guide')->name('guide.')->group(function () {
    Route::get('/dashboard', [GuideDashboardController::class, 'index'])->name('dashboard');
});

//
// ADMIN ROUTES (Untuk admin setelah login)
//
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/tour-guides', [AdminTourGuideController::class, 'index'])->name('tour-guides.index');
    Route::get('/admin/tour-guides/menunggu-verifikasi', [AdminTourGuideController::class, 'pending'])->name('tour-guides.pending');
    Route::get('/admin/tour-guides/menunggu-verifikasi/detail', [AdminTourGuideController::class, 'detail'])->name('tour-guides.detail');
    Route::get('/tour-guides/{id}', [AdminTourGuideController::class, 'show'])->name('tour-guides.detail');
    Route::post('/tour-guides/{id}/verify', [AdminTourGuideController::class, 'verify'])->name('tour-guides.verify');
    Route::post('/tour-guides/{id}/reject', [AdminTourGuideController::class, 'reject'])->name('tour-guides.reject');

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
// AUTH ROUTES (Laravel default: login, register, forgot, dll)
//
require __DIR__.'/auth.php';
