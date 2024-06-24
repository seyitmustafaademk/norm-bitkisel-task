<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Category\CategoryApiController;
use App\Http\Controllers\Admin\Period\PeriodApiController;
use App\Http\Controllers\Admin\Product\ProductApiController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::pattern('id', '[0-9]+');

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
        });
    });
});
