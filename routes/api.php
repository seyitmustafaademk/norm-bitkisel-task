<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Category\CategoryApiController;

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
    });
});
