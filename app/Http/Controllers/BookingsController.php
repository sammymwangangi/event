<?php

namespace App\Http\Controllers;

use App\ServiceBooking;
use Illuminate\Http\Request;
use App\Booking;
use App\VenueBooking;
use Auth;

class BookingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $bookings = Booking::all();
        $bookings = Booking::where('approved', 0)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();

        $approved_bookings = Booking::where('approved', 1)
            ->orderBy('id', 'desc')
            ->take(10)
            ->get();
        return view('bookings.index', compact('approved_bookings', 'bookings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

//    public function setTotal() {
//        $this->total = 0;
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $booking = new Booking();
        $booking->tickets = $request->tickets;
        $booking->total = $request->total;
        $booking->event_id = $request->event_id;
        $booking->user_id = Auth::id();
        $booking->save();

        return redirect('events')->with('success', 'Event has been booked successfully');
    }

    public function book_venue(Request $request)
    {
        $venue_booking = new VenueBooking();
        $venue_booking->venue_id = $request->venue_id;
        $venue_booking->user_id = Auth::id();
        $venue_booking->save();

        return redirect('bookings')->with('success', 'Venue has been booked successfully');
    }

    public function book_service(Request $request)
    {
        $service_booking = new ServiceBooking();
        $service_booking->service_id = $request->service_id;
        $service_booking->user_id = Auth::id();
        $service_booking->save();

        return redirect('bookings')->with('success', 'Service has been booked successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
