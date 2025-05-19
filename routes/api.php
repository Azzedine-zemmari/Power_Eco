<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
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
