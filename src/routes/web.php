<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
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
    
    Route::middleware(['role:staff|admin'])->group(function() {
        // Request Management
        Route::resource('requests', RequestController::class);
    });
    
    Route::middleware(['role:admin'])->group(function() {
        // Approval Routes
        Route::put('/requests/{id}/approve', [RequestController::class, 'approve'])->name('requests.approve');
        Route::put('/requests/{id}/reject', [RequestController::class, 'reject'])->name('requests.reject');
        
        // Supplier Management Routes
        Route::resource('suppliers', SupplierController::class);

        // Product Management Routes
        Route::resource('products', ProductController::class);
    
        // Users Management Routes
        Route::resource('users', UserController::class);
        
        // Export
        Route::get('/reports/export', [RequestController::class, 'export'])->name('reports.export');
    });
});
