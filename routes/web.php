<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;

// Public Route (Login)
Route::prefix('admin')->group(function(){
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'actionLogin'])->name('action-login');
});

// Admin Authenticated Routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function (){
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

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
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

    // Product Routes (Diperbaiki menggunakan ProductController)
    Route::get('/products/index', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update');

    // Order Route
    Route::get('/orders', [DashboardController::class, 'index'])->name('orders');
});