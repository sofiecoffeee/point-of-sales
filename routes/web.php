<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Auth\Middleware\Authenticate;


// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('admin')->group(function(){
    Route::get('/', [LoginController::class, 'login']);
    Route::post('/login', [LoginController::class, 'actionLogin'])->name('action-login');
});


Route::middleware([Authenticate::class])->prefix('admin')->name('admin.')->group(function(){
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    
    // User Route
    Route::get('/users/index', [UserController::class,'index'])->name('users');
    Route::get('/users/create', [UserController::class,'create'])->name('users.create');
    Route::post('/users/index', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class,'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');

    // Category Route
    Route::get('/categories/index', [CategoryController::class,'index'])->name('categories');
    Route::get('/categories/create', [CategoryController::class,'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class,'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');

    // Products Route
    Route::get('/products/index', [DashboardController::class,'index'])->name('products');
    Route::get('/products/create', [CategoryController::class,'create'])->name('products.create');
    Route::post('/products', [CategoryController::class, 'store'])->name('products.store');
    Route::get('/products/{id}/edit', [CategoryController::class,'edit'])->name('products.edit');
    Route::put('/products/{id}', [CategoryController::class, 'update'])->name('products.update');

    // Order Route
    Route::get('/orders', [DashboardController::class,'index'])->name('orders');
});

 