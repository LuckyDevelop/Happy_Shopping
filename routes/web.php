<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\VoucherController;

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
        Route::get('/edit/{id}', [ProductController::class, 'editData'])->name('product_edit');
        Route::post('/add', [ProductController::class, 'addData'])->name('product_add_post');
        Route::patch('/edit', [ProductController::class, 'editPatch'])->name('product_edit_patch');
        Route::delete('/delete/{id}', [ProductController::class, 'deleteData'])->name('product_delete');
    });

    Route::prefix('/product-category')->group(function () {
        Route::get('/', [CategoryController::class, 'view'])->name('category');
        Route::get('/edit/{id}', [CategoryController::class, 'editData'])->name('category_edit');
        Route::get('/auto', [CategoryController::class, 'auto'])->name('auto');
        Route::post('/add', [CategoryController::class, 'addData'])->name('category_add_post');
        Route::patch('/edit', [CategoryController::class, 'editPatch'])->name('category_edit_patch');
        Route::delete('/delete/{id}', [CategoryController::class, 'deleteData'])->name('category_delete');
    });

    Route::prefix('/transaction')->group(function () {
        Route::get('/', [TransactionController::class, 'view'])->name('transaction');
    });

    Route::prefix('/voucher')->group(function () {
        Route::get('/', [VoucherController::class, 'view'])->name('voucher');
        Route::get('/data', [VoucherController::class, 'data'])->name('voucher_data');
    });
});
