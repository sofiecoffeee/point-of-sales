<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function(){
 Route::get('/', [LoginController::class, 'login']);
 Route::post('/login', [LoginController::class, 'actionLogin'])->name('action-login');
 Route::resource('/dashboard', [DashboardController::class, 'dashboard']);
});