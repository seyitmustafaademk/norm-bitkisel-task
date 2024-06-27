<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;

use App\Http\Controllers\Front\Homepage\HomepageController;
use App\Http\Controllers\Front\Cart\CartController;



/*
|--------------------------------------------------------------------------
| AUTH Routes
|--------------------------------------------------------------------------
*/

Route::prefix('/')->name('auth.')->group(function() {
    Route::get('/login', [AuthController::class, 'index'])->name('index');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


/*
|--------------------------------------------------------------------------
| FRONT Routes
|--------------------------------------------------------------------------
*/
Route::prefix('/')->name('front.')->group(function() {
    Route::get('/sepet', [CartController::class, 'index'])
        ->middleware(['auth:sanctum'])
        ->name('cart');
    Route::get('/{category?}', [HomepageController::class, 'index'])->name('homepage');
});


/*
|--------------------------------------------------------------------------
| ADMIN Routes
|--------------------------------------------------------------------------
*/
