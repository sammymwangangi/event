<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VenueBooking;
use Auth;

class VenueBookingController extends Controller
{
    public function book_venue(Request $request)
    {
        $venue_booking = new VenueBooking();
        $venue_booking->venue_id = $request->venue_id;
        $venue_booking->user_id = Auth::id();
        $venue_booking->save();

        return redirect('bookings')->with('success', 'Venue has been booked successfully');
    }
}
