<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ReportController;
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

    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'change_password'])->name('profile.change_password');
    
    // Rating
    Route::patch('/suppliers/{supplier}/rating', [SupplierController::class, 'rating'])->name('suppliers.rating');
    
    // STAFF ONLY
    Route::middleware(['role:staff'])->group(function() {
        // Order 
        Route::get('/orders/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/orders/{order}/edit', [OrderController::class, 'edit'])->name('orders.edit');
        Route::match(['put', 'patch'], '/orders/{order}', [OrderController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{order}', [OrderController::class, 'destroy'])->name('orders.destroy');
    });  
    
    // ADMIN ONLY
    Route::middleware(['role:admin'])->group(function() {
        // Product
        Route::resource('products', ProductController::class)->except(['show']);

        // Accept Order
        Route::patch('/orders/{order}/status', [OrderController::class, 'status'])->name('orders.status');

        // Supplier 
        Route::resource('suppliers', SupplierController::class);
    
        // Users
        Route::resource('users', UserController::class);
        
        // Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports');
        Route::get('/reports/{report}', [ReportController::class, 'detail'])->name('reports.detail');
        Route::get('/reports/{report}/pdf', [ReportController::class, 'pdf'])->name('reports.pdf');
        Route::get('/reports/{report}/excel', [ReportController::class, 'excel'])->name('reports.excel');
    });

    // STAFF AND ADMIN
    Route::middleware(['role:admin|staff'])->group(function() {
        // Product 
        Route::get('/products', [ProductController::class, 'index'])->name('products.index');

        // Supplier 
        Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
        Route::get('/suppliers/{supplier}', [SupplierController::class, 'show'])->name('suppliers.show');

        // Order 
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
    });  
});