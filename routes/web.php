<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
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
        Route::get('/data', [ProductController::class, 'data'])->name('product_data');
        Route::get('/show/{id}', [ProductController::class, 'showData'])->name('product_show');
        Route::get('/edit/{id}', [ProductController::class, 'editData'])->name('product_edit');
        Route::get('/auto', [ProductController::class, 'auto'])->name('product_auto');
        Route::post('/add', [ProductController::class, 'addData'])->name('product_add_post');
        Route::patch('/edit', [ProductController::class, 'editPatch'])->name('product_edit_patch');
        Route::delete('/delete/{id}', [ProductController::class, 'deleteData'])->name('product_delete');
    });

    Route::prefix('/product-category')->group(function () {
        Route::get('/', [CategoryController::class, 'view'])->name('category');
        Route::get('/show/{id}', [CategoryController::class, 'showData'])->name('category_show');
        Route::get('/edit/{id}', [CategoryController::class, 'editData'])->name('category_edit');
        Route::get('/auto', [CategoryController::class, 'auto'])->name('auto');
        Route::post('/add', [CategoryController::class, 'addData'])->name('category_add_post');
        Route::patch('/edit', [CategoryController::class, 'editPatch'])->name('category_edit_patch');
        Route::delete('/delete/{id}', [CategoryController::class, 'deleteData'])->name('category_delete');
    });

    Route::prefix('/transaction')->group(function () {
        Route::get('/', [TransactionController::class, 'view'])->name('transaction');
        Route::get('/insert_product', [TransactionController::class, 'productData'])->name('transaction_view');
        Route::get('/data', [TransactionController::class, 'data'])->name('transaction_data');
        Route::get('/edit/{id}', [TransactionController::class, 'editData'])->name('transaction_edit');
        Route::get('/show/{id}', [TransactionController::class, 'showData'])->name('transaction_show');
        Route::post('/add', [TransactionController::class, 'addData'])->name('transaction_add_post');
        Route::patch('/edit/{id}', [TransactionController::class, 'editPatch'])->name('transaction_edit_patch');
    });

    Route::prefix('/history')->group(function () {
        // Route::get('/', [HistoryController::class, 'viewTransaction'])->name('transaction-detail');
        // Route::get('/data', [HistoryController::class, 'dataTransaction'])->name('transaction-detail_data');
        Route::get('/usage', [HistoryController::class, 'viewUsage'])->name('voucher-usage');
        Route::get('/usage/data', [HistoryController::class, 'dataUsage'])->name('voucher_data_usage');
    });

    Route::prefix('/voucher')->group(function () {
        Route::get('/', [VoucherController::class, 'view'])->name('voucher');
        Route::get('/show/{id}', [VoucherController::class, 'showData'])->name('voucher_show');
        Route::get('/data', [VoucherController::class, 'data'])->name('voucher_data');
        Route::get('/auto', [VoucherController::class, 'auto'])->name('voucher_auto');
        Route::get('/edit/{id}', [VoucherController::class, 'editData'])->name('voucher_edit');
        Route::post('/add', [VoucherController::class, 'addData'])->name('voucher_add_post');
        Route::patch('/edit', [VoucherController::class, 'editPatch'])->name('voucher_edit_patch');
        Route::delete('/delete/{id}', [VoucherController::class, 'deleteData'])->name('voucher_delete');
    });
});
