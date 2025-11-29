<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register',[UserController::class,'register']);
Route::post('login',[UserController::class,'login']);
Route::get('logout',[UserController::class,'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function(){
//-----------------------------------------------------
// for admin
Route::get('getAllTemporaryUsers',[UserController::class,'temporaryIndex'])->middleware('isAdmin');
Route::post('acceptUser/{id}',[UserController::class,'acceptUser'])->middleware('isAdmin');
/////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////
// for landlord مؤجر
Route::middleware('isLandlord')->group(function(){

    Route::apiResource('apartment',ApartmentController::class);
    Route::post('confirmBooking/{booking_id}',[ApartmentController::class,'confirmBooking']);
});
/////////////////////////////////////////////////////////////////


/////////////////////////////////////////////////////////////////
// for tenant مستاجر
Route::middleware('isTenant')->group(function(){

    Route::get('apartmentForTenant',[ApartmentController::class,'indexAll']);
    Route::get('apartmentForTenant/{id}',[ApartmentController::class,'showForTenant']);
});
/////////////////////////////////////////////////////////////////


});