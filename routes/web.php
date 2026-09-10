<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;



// Route::get('/', function () {
//     return view('welcome');
// });

Route::prefix('admin')->group(function(){
    Route::get('/', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'actionLogin'])->name('action-login');
});

    Route::middleware('auth')->prefix('admin')->name('admin.')->group(function (){

    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    
    // User Route
    Route::get('/users', [UserController::class,'index'])->name('admin.users.index');
    Route::get('/users/create', [UserController::class,'create'])->name('admin.users.create');
    Route::post('/users/index', [UserController::class, 'store'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [UserController::class,'edit'])->name('admin.users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('admin.users.update');

    // Category Route
    Route::get('/categories', [CategoryController::class,'index'])->name('admin.categories.index');
    Route::get('/categories/create', [CategoryController::class,'create'])->name('admin.categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class,'edit'])->name('admin.categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('admin.categories.update');

    // Products Route
    Route::get('/products', [DashboardController::class,'index'])->name('admin.products.index');
    Route::get('/products/create', [CategoryController::class,'create'])->name('admin.products.create');
    Route::post('/products', [CategoryController::class, 'store'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [CategoryController::class,'edit'])->name('admin.products.edit');
    Route::put('/products/{id}', [CategoryController::class, 'update'])->name('admin.products.update');

    // Order Route
    Route::get('/orders', [DashboardController::class,'index'])->name('admin.orders');
});
