<?php

use App\Http\Controllers\API\ProductsController;
use App\Http\Controllers\API\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::get('category', [CategoryController::class,'index']);
Route::post('categoryad', [CategoryController::class,'add']);