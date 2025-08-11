<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/restaurants', [RestaurantController::class, 'getAllRestaurants']);
Route::get('/restaurants/{restaurant}/bookings', [RestaurantController::class, 'getBookings']);
Route::post('/bookings', [RestaurantController::class, 'addBooking']);
