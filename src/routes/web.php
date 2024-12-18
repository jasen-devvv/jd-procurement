<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SupplierController;

// Authentication Routes
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
    
    // Export
    Route::get('/reports/export', [RequestController::class, 'export'])->name('reports.export');
});
