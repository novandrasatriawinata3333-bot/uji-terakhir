<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [DosenController::class, 'index'])->name('home');
Route::get('/dosen/{id}', [DosenController::class, 'show'])->name('dosen.show');
Route::post('/dosen/{id}/booking', [DosenController::class, 'storeBooking'])->name('dosen.booking');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::resource('jadwal', JadwalController::class);
    
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
    Route::post('/booking/{id}/approve', [BookingController::class, 'approve'])->name('booking.approve');
    Route::post('/booking/{id}/reject', [BookingController::class, 'reject'])->name('booking.reject');
    
    Route::post('/api/status/update', [StatusController::class, 'update'])->name('status.update');
});

require __DIR__.'/auth.php';
