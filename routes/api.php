<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [AuthController::class, 'register']);
    });

    Route::middleware('jwt.override')->group(function () {
        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, 'getProducts']);
            Route::post('/store', [ProductController::class, 'storeProduct']);
            Route::post('/update', [ProductController::class, 'updateProduct']);
            Route::post('/delete', [ProductController::class, 'deleteProduct']);
        });
        Route::prefix('category-products')->group(function () {
            Route::get('/', [CategoryProductController::class, 'getCategoryProducts']);
            Route::post('/store', [CategoryProductController::class, 'storeCategoryProduct']);
            Route::post('/update', [CategoryProductController::class, 'updateCategoryProduct']);
            Route::post('/delete', [CategoryProductController::class, 'deleteCategoryProduct']);
        });
        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'getUsers']);
            Route::post('/store', [UserController::class, 'createUser']);
            Route::post('/update', [UserController::class, 'updateUser']);
            Route::post('/delete', [UserController::class, 'deleteUser']);
        });
        Route::prefix('transactions')->group(function () {
            Route::get('/', [TransactionController::class, 'getTransactions']);
            Route::post('/new', [TransactionController::class, 'newTransaction']);
        });
    });
});
