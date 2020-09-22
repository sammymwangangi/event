<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ServiceBooking;
use Auth;

class ServiceBookingController extends Controller
{
    public function book_service(Request $request)
    {
        $service_booking = new ServiceBooking();
        $service_booking->service_id = $request->service_id;
        $service_booking->user_id = Auth::id();
        $service_booking->save();

        return redirect('bookings')->with('success', 'Service has been booked successfully');
    }
}
