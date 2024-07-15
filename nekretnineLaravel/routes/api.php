<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RatingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PropertyTypeController;
use App\Http\Controllers\StatistikaController;

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
 
// Route::post('/register',[AuthController::class,'register']);
// Route::post('/login',[AuthController::class,'login']);

// Route::get('/properties/search',[PropertyController::class,'search']);
// Route::get('/properties',[PropertyController::class,'index']);
// Route::get('/properties/{id}',[PropertyController::class,'show']);


 

// Route::middleware(['auth:sanctum'])->group(function () {

//     Route::get('/user', [AuthController::class, 'user']); 
//     Route::post('/logout', [AuthController::class, 'logout']);


//     Route::delete('/properties/{id}',[PropertyController::class,'destroy']);
//     Route::post('/properties',[PropertyController::class,'store']);
//     Route::put('/properties/{id}',[PropertyController::class,'update']);

//     Route::resource('/purchase',PurchaseController::class);
//     Route::resource('/rating',RatingController::class);


// });


Route::get('property-types', [PropertyTypeController::class, 'index']);
 

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);



 

Route::middleware(['auth:sanctum'])->group(function () {

    Route::get('/user', [AuthController::class, 'user']); 
    Route::post('/logout', [AuthController::class, 'logout']); 
    Route::get('/statistics', [StatistikaController::class, 'statistics']);

    Route::resource('/purchase',PurchaseController::class);
    Route::middleware(['checkrole:kupac'])->group(function () {
       
        Route::resource('/rating',RatingController::class);
    });
    Route::middleware(['checkrole:prodavac'])->group(function () {
        Route::delete('/properties/{id}',[PropertyController::class,'destroy']); 
        Route::put('/properties/{id}',[PropertyController::class,'update']);
        Route::post('/properties',[PropertyController::class,'store']);
        
    });

});


Route::get('/properties/search',[PropertyController::class,'search']);
Route::get('/properties',[PropertyController::class,'index']);
Route::get('/properties/{id}',[PropertyController::class,'show']);