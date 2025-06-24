<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommercialController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductManagerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FactureController;

// For cors error
Route::options('/{any}', function () {
    return response()->noContent()
        ->header('Access-Control-Allow-Origin', '*')
        ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
        ->header('Access-Control-Allow-Headers', 'Content-Type, Authorization');
})->where('any', '.*');

// Public routes (no authentication required)
Route::post('/login', [UserController::class, 'login']);
Route::post('/UserRegister', [UserController::class, 'UserRegistre']);
Route::post('/set-password', [UserController::class, 'setPassword']);
Route::post('/forgot-password', [UserController::class, 'forgotPassword']);
Route::post('/reset-password', [UserController::class, 'resetPassword']);
Route::get('/featured-products', [ProductController::class, 'getFeaturedProducts']);
Route::get('/products', [ProductController::class, 'show']);
Route::get('/product/{id}', [ProductController::class, 'showProductDetails']);


// Admin-only routes
Route::middleware(['auth:sanctum', 'role:admin'])->group(function(){
    Route::delete('/users/{id}/archive', [UserController::class, 'archiveUser']);
    Route::get('/Users', [UserController::class, 'show']);
    Route::post('/users/{id}/active', [UserController::class, 'activeUser']);
    Route::post('/register', [UserController::class, 'createUser']);
});

// Product Manager-only routes
Route::middleware(['auth:sanctum', 'role:product-manager'])->group(function(){
    Route::get('/categories', [CategoryController::class, 'show']);
    Route::post('/categories/create', [CategoryController::class, 'createCategory']);
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    Route::post('/products/create', [ProductController::class, 'create']);
    Route::get('/product-manager/products', [ProductController::class, 'ProductShow']);
    Route::put('/products/{id}/update', [ProductController::class, 'update']);
    Route::post('/products/{id}/delete', [ProductController::class, 'destroy']);
    Route::post('/import-products', [ProductController::class, 'import']);
    Route::get('/product-manager/stats', [ProductManagerController::class, 'getStats']);
});

// Commercial-only routes
Route::middleware(['auth:sanctum', 'role:commercial'])->group(function(){
    Route::get('/sales/data', [CommercialController::class, 'sales']);
Route::put('/sales/update/{id}', [CommercialController::class, 'update']);
});

// General authenticated routes (any authenticated user)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [UserController::class, 'logout']);
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('/user/data', [UserController::class, 'getUserData']);
    Route::put('/user/data/update', [UserController::class, 'update']);
});

// All authenticated user can access 
// Route::middleware(['auth:sanctum'])->group(function(){
// });
// User-only routes
Route::middleware(['auth:sanctum', 'role:user'])->group(function(){
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'getCartItem']);
    Route::put('/cart/{productId}', [CartController::class, 'update']);
    Route::delete('/cart/{productId}/drop', [CartController::class, 'dropItem']);
    Route::post('/checkout', [CheckoutController::class, 'checkout']);
    Route::get('/cart/count', [CartController::class, 'count']);
    Route::get('/devis', [DevisController::class, 'show']);
    Route::get('/factures', [FactureController::class, 'show']);
});