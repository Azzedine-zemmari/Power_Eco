<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommercialController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductManagerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/test',function(){
    return "Hello from laravel";
});

Route::post('/register',[UserController::class,'createUser']);
Route::get('/Users',[UserController::class,'show']);
Route::post('/login',[UserController::class,'login']);
Route::post('/UserRegister',[UserController::class,'UserRegistre']);
Route::middleware('auth:sanctum')->post('/logout',[UserController::class,'logout']);
Route::middleware('auth:sanctum')->post('/categories/create',[CategoryController::class,'createCategory']);
Route::post('/set-password', [UserController::class, 'setPassword']);
Route::delete('/users/{id}/archive', [UserController::class, 'archiveUser'])->middleware('auth:sanctum');
Route::get('/categories',[CategoryController::class,'show'])->middleware('auth:sanctum');
Route::post('/products/create',[ProductController::class,'create']);
Route::get('/products',[ProductController::class,'show']);
Route::put('/products/{id}/update',[ProductController::class,'update']);
Route::post('/products/{id}/delete',[ProductController::class,'destroy']);
Route::post('/users/{id}/active',[UserController::class,'activeUser']);
Route::post('/forgot-password',[UserController::class,'forgotPassword']);
Route::post('/reset-password',[UserController::class,'resetPassword']);
Route::post('/import-products', [ProductController::class, 'import']);
Route::post('/products',[ProductController::class,'showProducts']);
Route::get('/product/{id}',[ProductController::class,'showProductDetails']);
Route::middleware('auth:sanctum')->post('/cart/add', [CartController::class, 'addToCart']);
Route::middleware('auth:sanctum')->get('/cart', [CartController::class, 'getCartItem']);
Route::middleware('auth:sanctum')->put('/cart/{productId}', [CartController::class, 'update']);
Route::middleware('auth:sanctum')->delete('/cart/{productId}/drop', [CartController::class, 'dropItem']);
Route::middleware('auth:sanctum')->post('/checkout', [CheckoutController::class, 'checkout']);
Route::middleware('auth:sanctum')->get('/user/data',[UserController::class,'getUserData']);
Route::middleware('auth:sanctum')->put('/user/data/update',[UserController::class,'update']);
Route::middleware('auth:sanctum')->get('/sales/data',[CommercialController::class,'sales']);
Route::middleware('auth:sanctum')->get('/cart/count',[CartController::class,'count']);
Route::middleware('auth:sanctum')->put('/sales/update/{id}',[CommercialController::class,'update']);
Route::get('/featured-products', [ProductController::class, 'getFeaturedProducts']);

// Product Manager Dashboard Routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/product-manager/stats', [ProductManagerController::class, 'getStats']);
});
