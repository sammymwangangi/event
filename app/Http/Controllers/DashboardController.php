<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Booking;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index() {
    	$bookings = Booking::all();
    	return view('dashboard.index', compact('bookings'));
    }

    public function changeBookingStatus(Request $request)
    {
        $booking = Booking::find($request->booking_id);
        $booking->approved = $request->approved;
        $booking->save();
  
        return response()->json(['success'=>'Booking status changed successfully.']);
    }

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
