<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChefsController;
use App\Http\Controllers\MealsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrderItemsController;
use Illuminate\Support\Facades\Auth;

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
// user
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});


// Protected routes

Route::prefix('v1')->middleware(['cors','auth:sanctum'])->group(function () {
    // Route::resource('meals', MealsController::class);  
    Route::post('/meals/create', [MealsController::class, 'store'])->name('meal')->middleware('chef');
    Route::put('/meals/{id}', [MealsController::class, 'update'])->name('meal_update')->middleware('chef');

    // logout
    Route::post('/logout',[UsersController::class,'logout']);
    // resources
    Route::resource('/categories', CategoriesController::class)->middleware(['admin']);
    Route::resource('/reviews', ReviewsController::class);
    Route::resource('/chefs', ChefsController::class)->middleware(['chef','admin']);
    Route::resource('/order_items', OrderItemsController::class)->middleware('customer');
    
});

// Public routes
Route::prefix('v1')->group(function (){
    

        // user routes
        Route::post('/register',[UsersController::class,'register'])->name('register');
        Route::post('/login',[UsersController::class,'login'])->name('login');

        // view meals
        Route::get('/meals', [MealsController::class, 'index']);
        Route::get('/meals/{id}', [MealsController::class, 'show']);

});

