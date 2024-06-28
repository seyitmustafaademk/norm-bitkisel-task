<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\Category\CategoryApiController;
use App\Http\Controllers\Admin\Period\PeriodApiController;
use App\Http\Controllers\Admin\Product\ProductApiController;

use App\Http\Controllers\Front\Cart\CartApiController;

Route::pattern('id', '[0-9]+');
/*
|--------------------------------------------------------------------------
| ADMIN Routes
|--------------------------------------------------------------------------
*/

Route::prefix('/v1')->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::prefix('/categories')->group(function () {
            Route::get('/', [CategoryApiController::class, 'index']);
            Route::get('/{id}', [CategoryApiController::class, 'show']);
            Route::post('/', [CategoryApiController::class, 'store']);
            Route::put('/{id}', [CategoryApiController::class, 'update']);
            Route::delete('/{id}', [CategoryApiController::class, 'destroy']);
            Route::delete('/{id}/force-delete', [CategoryApiController::class, 'forceDelete']);
            Route::patch('/{id}/restore', [CategoryApiController::class, 'restore']);
        });
        Route::prefix('/periods')->group(function () {
            Route::get('/', [PeriodApiController::class, 'index']);
            Route::get('/{id}', [PeriodApiController::class, 'show']);
            Route::post('/', [PeriodApiController::class, 'store']);
            Route::put('/{id}', [PeriodApiController::class, 'update']);
            Route::delete('/{id}', [PeriodApiController::class, 'destroy']);
            Route::delete('/{id}/force-delete', [PeriodApiController::class, 'forceDelete']);
            Route::patch('/{id}/restore', [PeriodApiController::class, 'restore']);
        });
        Route::prefix('/products')->group(function () {
            Route::get('/', [ProductApiController::class, 'index']);
            Route::get('/{id}', [ProductApiController::class, 'show']);
            Route::post('/', [ProductApiController::class, 'store']);
            Route::put('/{id}', [ProductApiController::class, 'update']);
            Route::delete('/{id}', [ProductApiController::class, 'destroy']);
            Route::delete('/{id}/force-delete', [ProductApiController::class, 'forceDelete']);
            Route::patch('/{id}/restore', [ProductApiController::class, 'restore']);
            Route::patch('/{id}/update-image', [ProductApiController::class, 'updateImage']);
        });
    });
});



/*
|--------------------------------------------------------------------------
| FRONTEND Routes
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Front\Homepage\HomepageApiController;

Route::prefix('/')->name('front.')->group(function () {
    Route::prefix('/')->name('homepage.')->group(function () {
        Route::get('/get-categories', [HomepageApiController::class, 'getCategories'])->name('categories');
        Route::get('/{category?}', [HomepageApiController::class, 'getProducts'])->name('products');
    });
    Route::prefix('/basket')->name('basket.')->middleware('auth:sanctum')->group(function () {
        Route::get('/get-basket-products', [CartApiController::class, 'getBasketProducts'])->name('index');
        Route::post('/{id}/add', [CartApiController::class, 'addProduct'])->name('add');
        Route::post('/{id}/remove', [CartApiController::class, 'removeProduct'])->name('remove');
        Route::post('/{id}/increase', [CartApiController::class, 'increaseQuantity'])->name('increase');
        Route::post('/{id}/decrease', [CartApiController::class, 'decreaseQuantity'])->name('decrease');

        Route::get('/welcome-campaign', [CartApiController::class, 'getWelcomeCampaign'])->name('welcome-campaign');
    });
});
