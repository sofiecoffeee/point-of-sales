<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;

// Public Route (Login)
Route::prefix('admin')->group(function(){
    
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'actionLogin'])->name('action-login');



Route::middleware('auth')->group(function() {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/data', [DashboardController::class, 'data'])->name('dashboard.data');
    
    
    // Users Route kalo pake resource
    Route::resource('/users', UserController::class);
    
    // detail route
    // User Routes (URL tetap menggunakan /index di belakang)
    // Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
    // Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    // Route::post('/users/index', [UserController::class, 'store'])->name('users.store');
    // Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    // Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    
    // Role Controller
    Route::resource('/roles', RoleController::class);
    
    // Category Routes
    Route::resource('/categories', CategoryController::class);
    
    // Product Routes (Diperbaiki menggunakan ProductController)
    Route::resource('/products', ProductController::class);
    
    // Order Route
    Route::get('/orders/data', [OrderController::class, 'data'])->name('orders.data');
    Route::resource('/orders', OrderController::class);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    });

    // // Route::middleware('auth', 'cashier')->group(function(){
    // // Route::resource('/orders', OrderController::class);

    // });
 });
        
        
  
 