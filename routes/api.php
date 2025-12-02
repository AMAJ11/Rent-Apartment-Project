<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Http\ResponseTrait;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('logout', [UserController::class, 'logout'])->middleware('auth:sanctum');


Route::middleware('auth:sanctum')->group(function () {
    //-----------------------------------------------------
    // for admin
    Route::get('getAllTemporaryUsers', [UserController::class, 'temporaryIndex'])->middleware('isAdmin');
    Route::post('acceptUser/{id}', [UserController::class, 'acceptUser'])->middleware('isAdmin');
    /////////////////////////////////////////////////////////////////


    /////////////////////////////////////////////////////////////////
    // for landlord مؤجر
    Route::middleware('isLandlord')->group(function () {

        Route::apiResource('apartment', ApartmentController::class);
        Route::get('showBookingsForApartment/{id}', [ApartmentController::class, 'showBookingsForApartment']);
        Route::get('showAllBookingsForLandlord', [ApartmentController::class, 'showAllBookings']);
        Route::post('confirmBooking/{booking_id}', [ApartmentController::class, 'confirmBooking']);
    });
    /////////////////////////////////////////////////////////////////


    /////////////////////////////////////////////////////////////////
    // for tenant مستاجر
    Route::middleware('isTenant')->group(function () {

        Route::get('apartment/ForTenant', [ApartmentController::class, 'indexAll']);
        Route::get('apartment/ForTenant/{id}', [ApartmentController::class, 'showForTenant']);
        Route::post('apartment/toggleFavourite', [ApartmentController::class, 'toggleFavorite']);
        Route::get('', [ApartmentController::class, 'getFavorites']);
        //#######################################################################################
        Route::apiResource('booking', BookingController::class)->except(['store']);

        Route::post('booking/{apartment_id}', [BookingController::class, 'store']);
        // Route::get('booking',[BookingController::class,'index']);
        // Route::get('booking/{id}',[BookingController::class,'show']);
        // Route::put('booking/{id}',[BookingController::class,'update']);
        // Route::delete('booking/{id}',[BookingController::class,'destroy']);
    });
    /////////////////////////////////////////////////////////////////


});
