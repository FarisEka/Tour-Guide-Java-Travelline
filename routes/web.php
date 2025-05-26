<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\TourGuideController as AdminTourGuideController;
use App\Http\Controllers\Guide\DashboardController as GuideDashboardController;
use App\Http\Controllers\TourGuideRegistrationController;
use App\Http\Controllers\TourGuidePublicController;
use App\Http\Controllers\BookingController;



Route::get('/test-login-route', function () {
    return route('login');
});
//
// PUBLIC ROUTES (Untuk traveller, tanpa login)
//
Route::view('/', 'traveller.home')->name('home');
Route::get('/cari-guide', [TourGuidePublicController::class, 'cari'])->name('cari.guide');


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
    Route::get('/tour-guides/menunggu-verifikasi', [AdminTourGuideController::class, 'pending'])->name('tour-guides.pending');
    Route::get('/tour-guides/menunggu-verifikasi/detail', [AdminTourGuideController::class, 'detail'])->name('tour-guides.detail');
    Route::post('/tour-guides/{id}/verify', [AdminTourGuideController::class, 'verifyGuide'])->name('tour-guides.verify');
    Route::post('/tour-guides/{id}/reject', [AdminTourGuideController::class, 'rejectGuide'])->name('tour-guides.reject');
    Route::get('/tour-guides/terverifikasi', [AdminTourGuideController::class, 'terverifikasi'])->name('tour-guides.terverifikasi');
    Route::get('/tour-guides/{id}', [AdminTourGuideController::class, 'show'])->name('tour-guides.detail');

});

//
// AUTHENTICATED USER PROFILE
//
Route::middleware('auth')->group(function () {
    Route::get('/daftar-tour-guide', [TourGuideRegistrationController::class, 'create'])->name('tour-guide.create');
    Route::post('/daftar-tour-guide', [TourGuideRegistrationController::class, 'store'])->name('tour-guide.store');
     Route::get('/booking/{id}', [BookingController::class, 'create'])->name('booking.form');
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//
// AUTH ROUTES (Laravel default: login, register, forgot, dll)
//
require __DIR__ . '/auth.php';
