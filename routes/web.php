<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/support', function () {
    return view('support'); // Ya jo bhi support page ka view hai
})->name('support');

// Ya agar controller use karna hai toh
// Route::get('/support', [SupportController::class, 'index'])->name('support');

// Role-based dashboard routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Main dashboard - automatically redirects based on role
    Route::get('/dashboard', [DashboardController::class, 'redirectToRoleDashboard'])
        ->name('dashboard');
    
    // Specific dashboard routes
    Route::get('/admin-dashboard', [DashboardController::class, 'adminDashboard'])
        ->name('admin.dashboard');
        
    Route::get('/user-dashboard', [DashboardController::class, 'userDashboard'])
        ->name('user.dashboard');
        
    Route::get('/sales-dashboard', [DashboardController::class, 'salesDashboard'])
        ->name('sales.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';