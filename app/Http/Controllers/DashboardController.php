<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Booking;
use App\VenueBooking;
use App\ServiceBooking;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
        // $mybookings = Booking::where(['user_id'=>Auth::user()->id])->orderBy('id', 'desc')->get();
    	$bookings = Booking::all();
        $venue_bookings = VenueBooking::all();
        $service_bookings = ServiceBooking::all();
    	return view('dashboard.index', compact('bookings','venue_bookings','service_bookings'));
    }

    public function changeBookingStatus(Request $request)
    {
        $booking = Booking::find($request->booking_id);
        $booking->approved = $request->approved;
        $booking->save();
  
        return response()->json(['success'=>'Booking status changed successfully.']);
    }

    // public function changeVenueBookingStatus(Request $request)
    // {
    //     $v_booking = VenueBooking::find($request->venue_booking_id);
    //     $v_booking->approved = $request->approved;
    //     $v_booking->save();
  
    //     return response()->json(['success'=>'Venue Booking status changed successfully.']);
    // }

    // public function changeBookingStatus(Request $request)
    // {
    //     $booking = Booking::find($request->booking_id);
    //     $booking->approved = $request->approved;
    //     $booking->save();
  
    //     return response()->json(['success'=>'Booking status changed successfully.']);
    // }

    public function print_bookings()
    {
        $bookings = Booking::all();

        $pdf = PDF::loadView('dashboard.print-bookings',
            [
                'bookings' => $bookings
            ]
        )
            ->setPaper('a4', 'landscape');
        return $pdf->stream('bookings-list.pdf');
    }
}
