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

Route::namespace('admin')->middleware('auth', 'otorisasi')->group(function(){
    Route::prefix('/dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'view'])->name('dashboard_view_index');
    });

    Route::prefix('/product')->group(function () {
        Route::get('/', [ProductController::class, 'view'])->name('product_view_index');
        Route::get('/data', [ProductController::class, 'data'])->name('product_view_data');
        Route::get('/show/{id}', [ProductController::class, 'showData'])->name('product_view_show');
        Route::get('/edit/{id}', [ProductController::class, 'editData'])->name('product_edit');
        Route::get('/auto', [ProductController::class, 'auto'])->name('product_auto');
        Route::post('/add', [ProductController::class, 'addData'])->name('product_add_post');
        Route::patch('/edit', [ProductController::class, 'editPatch'])->name('product_edit_patch');
        Route::delete('/delete/{id}', [ProductController::class, 'deleteData'])->name('product_delete');
    });

    Route::prefix('/product-category')->group(function () {
        Route::get('/', [CategoryController::class, 'view'])->name('category_view_index');
        Route::get('/show/{id}', [CategoryController::class, 'showData'])->name('category_view_show');
        Route::get('/edit/{id}', [CategoryController::class, 'editData'])->name('category_edit');
        Route::get('/auto', [CategoryController::class, 'auto'])->name('auto');
        Route::post('/add', [CategoryController::class, 'addData'])->name('category_add_post');
        Route::patch('/edit', [CategoryController::class, 'editPatch'])->name('category_edit_patch');
        Route::delete('/delete/{id}', [CategoryController::class, 'deleteData'])->name('category_delete');
    });

    Route::prefix('/transaction')->group(function () {
        Route::get('/', [TransactionController::class, 'view'])->name('transaction_view_index');
        Route::get('/insert_product', [TransactionController::class, 'productData'])->name('transaction_view');
        Route::get('/data', [TransactionController::class, 'data'])->name('transaction_view_data');
        Route::get('/edit/{id}', [TransactionController::class, 'editData'])->name('transaction_edit');
        Route::get('/show/{id}', [TransactionController::class, 'showData'])->name('transaction_view_show');
        Route::post('/add', [TransactionController::class, 'addData'])->name('transaction_add_post');
        Route::patch('/edit/{id}', [TransactionController::class, 'editPatch'])->name('transaction_edit_patch');
    });

    Route::prefix('/history')->group(function () {
        // Route::get('/', [HistoryController::class, 'viewTransaction'])->name('transaction-detail_view_index');
        // Route::get('/data', [HistoryController::class, 'dataTransaction'])->name('transaction-detail_view_data');
    });

    Route::prefix('/voucher')->group(function () {
        Route::get('/', [VoucherController::class, 'view'])->name('voucher_view_index');
        Route::get('/show/{id}', [VoucherController::class, 'showData'])->name('voucher_view_show');
        Route::get('/data', [VoucherController::class, 'data'])->name('voucher_view_data');
        Route::get('/auto', [VoucherController::class, 'auto'])->name('voucher_view_auto');
        Route::get('/edit/{id}', [VoucherController::class, 'editData'])->name('voucher_edit');
        Route::post('/add', [VoucherController::class, 'addData'])->name('voucher_add_post');
        Route::patch('/edit', [VoucherController::class, 'editPatch'])->name('voucher_edit_patch');
        Route::delete('/delete/{id}', [VoucherController::class, 'deleteData'])->name('voucher_delete');
    });

    Route::prefix('/voucher-usage')->group(function () {
        Route::get('/', [HistoryController::class, 'viewUsage'])->name('voucher-usage_view');
        Route::get('/data', [HistoryController::class, 'dataUsage'])->name('voucher-usage_view_data');
    });
});
