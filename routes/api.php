<?php

use App\Http\Controllers\API\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::get('products', [ProductsController::class,'index']);
Route::post('add', [ProductsController::class,'add']);
Route::post('update/{id}', [ProductsController::class,'update']);
Route::get('edit/{id}', [ProductsController::class,'edit']);
Route::delete('delete/{id}', [ProductsController::class,'delete']);
