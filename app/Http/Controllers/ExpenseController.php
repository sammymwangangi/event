<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Booking;
use App\Venue;
use App\Service;
use App\ServiceBooking;
use App\VenueBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Auth;

class ExpenseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bookings = Booking::all();
        $venue_bookings = VenueBooking::where(['user_id'=>Auth::user()->id])->orderBy('id', 'desc')->get();
        $service_bookings = ServiceBooking::where(['user_id'=>Auth::user()->id])->orderBy('id', 'desc')->get();

        // $bookings = Booking::all();
        // $venue_bookings = VenueBooking::all();
        // $service_bookings = ServiceBooking::all();

        return view('dashboard.expenses', compact('bookings', 'service_bookings', 'venue_bookings'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function show(Expense $expense)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit(Expense $expense)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        //
    }

    public function print_expenses()
    {

        $bookings = Booking::all();
        $venue_bookings = VenueBooking::all();
        $service_bookings = ServiceBooking::all();

        $pdf = PDF::loadView('dashboard.print-expenses',
            [
                'bookings' => $bookings,
                'venue_bookings' => $venue_bookings,
                'service_bookings' => $service_bookings
            ]
        )
            ->setPaper('a4', 'landscape');
        return $pdf->stream('bookings-list.pdf');
    }
}
