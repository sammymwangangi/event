<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Event;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $events = Event::all();
        return view('welcome', compact('categories', 'events'));
    }
}
