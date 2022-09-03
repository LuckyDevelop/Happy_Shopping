<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('dashboard');
});

Route::prefix('/login')->group(function() {
    Route::get('/', [AuthController::class,'index'])->name('login');
    Route::post('/', [AuthController::class,'processLogin'])->name('login_process');
    Route::get('/logout', [AuthController::class,'processLogout'])->name('logout_process');
});

Route::prefix('/sign-up')->group(function() {
    Route::get('/', [RegisterController::class,'signUp'])->name('sign-up');
    Route::post('/register', [RegisterController::class,'register'])->name('register');
});

Route::namespace('admin')->middleware('auth')->group(function(){
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'view'])->name('dashboard');
    });

    Route::prefix('/product')->group(function () {
        Route::get('/', [ProductController::class, 'view'])->name('product');
    });
});
