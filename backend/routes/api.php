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

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::get('/properties/search',[PropertyController::class,'search']);
Route::get('/properties',[PropertyController::class,'index']);
Route::get('/properties/{id}',[PropertyController::class,'show']);


 

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user', [AuthController::class, 'user']); 
    Route::post('/logout', [AuthController::class, 'logout']);


    
    Route::middleware(['checkrole:prodavac'])->group(function () {
        Route::delete('/properties/{id}',[PropertyController::class,'destroy']);
        Route::post('/properties',[PropertyController::class,'store']);
        Route::put('/properties/{id}',[PropertyController::class,'update']);
    
        Route::resource('/purchase',PurchaseController::class);
    });

    Route::middleware(['checkrole:kupac'])->group(function () {
        Route::resource('/rating',RatingController::class);
    });


});
