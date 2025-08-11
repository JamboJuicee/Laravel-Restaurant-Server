<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function getAllRestaurants() {
        return Restaurant::all();
    }

    public function getBookings(Restaurant $restaurant) {
        return $restaurant->bookings;
    }

    public function addBooking(Request $request) {
        $booking = new Booking($request->all());
        $booking->save();
        
        return response()->json($booking, 201);
    }

}
