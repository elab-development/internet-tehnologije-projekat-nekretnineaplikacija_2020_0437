<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/properties/search',[PropertyController::class,'search']);
Route::get('/properties',[PropertyController::class,'index']);
Route::get('/properties/{id}',[PropertyController::class,'show']);

Route::delete('/properties/{id}',[PropertyController::class,'destroy']);
Route::post('/properties',[PropertyController::class,'store']);
Route::put('/properties/{id}',[PropertyController::class,'update']);

Route::resource('/purchase',PurchaseController::class);

Route::resource('/rating',RatingController::class);
