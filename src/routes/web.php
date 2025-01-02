<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;

// Authentication Routes
Route::prefix('auth')->group(function() {
    Route::get('login', [AuthController::class, 'loginForm'])->middleware(['guest'])->name('login.form');
    Route::post('login', [AuthController::class, 'login'])->middleware(['guest'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('dashboard')->middleware(['auth'])->group(function() { 
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [DashboardController::class, 'profile'])->name('profile');


    // Product Management Routes
    Route::resource('products', ProductController::class)->except(['show']);
    
    Route::middleware(['role:staff'])->group(function() {
        // Request Management Routes
        Route::resource('requests', RequestController::class);

        // Supplier Management Routes
        Route::resource('suppliers', SupplierController::class)->only(['index']);
    });  
    
    Route::middleware(['role:admin'])->group(function() {
        // Approval Routes
        Route::patch('/requests/{id}/status', [RequestController::class, 'status'])->name('requests.status');

        // Request Management Routes
        Route::resource('requests', RequestController::class)->only(['index', 'show']);

        // Supplier Management Routes
        Route::resource('suppliers', SupplierController::class);
    
        // Users Management Routesonly
        Route::resource('users', UserController::class);
        
        // Export
        Route::get('/reports/export', [RequestController::class, 'export'])->name('reports.export');
    });
});
