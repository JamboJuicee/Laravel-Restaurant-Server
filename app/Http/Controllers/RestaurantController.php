<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Restaurant;
use Illuminate\Http\Request;

class RestaurantController extends Controller
{
    public function getAllRestaurants() {
        return [ "data" => Restaurant::all() ];
    }

    public function getBookings(Restaurant $restaurant) {
        return [ "data" => $restaurant -> bookings ];
    }

    public function addBooking(Request $request) {
        $booking = new Booking($request -> all());

        $booking -> save();
        
        return $booking;
    }

}
