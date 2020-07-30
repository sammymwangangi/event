<?php

namespace App\Http\Controllers;

use App\Event;
use App\Service;
use App\Venue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $myvenues = Venue::where('user_id', Auth::id())->paginate(5);
        $myevents = Event::where('user_id', Auth::id())->paginate(5);
        $myservices = Service::where('user_id', Auth::id())->paginate(5);
        return view('home', compact('myvenues', 'myevents', 'myservices'));
    }
}
