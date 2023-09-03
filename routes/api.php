<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\CategoriesController;

// 404 page 
//  vendor/laravel/framework/src/Illuminate/Foundation/Exceptions/views/404.blade.php
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
Route::prefix('v1')->group(function () {
    // Route::resource('meals', MealsController::class);
    Route::get('/meals', [MealsController::class, 'index']);
    Route::get('/meals/{id}', [MealsController::class, 'show']);
    Route::post('/meals/create', [MealsController::class, 'store']);
    Route::put('/meals/{id}', [MealsController::class, 'update']);
    // Route::get('/meals',);
});
Route::prefix('v1')->group(function () {
    Route::resource('/categories', CategoriesController::class);
});

