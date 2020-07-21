<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Event;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $events = Event::all();
        return view('welcome', compact('categories', 'events'));
    }

    public function search(Request $request){
        $search = $request->get('search');
        $categories = DB::table('categories')->where('name', 'like', '%'.$search.'%');
        $events = DB::table('events')->where('name', 'like', '%'.$search.'%');
        $events = $events->get();
        $categories = $categories->get();
        return view('search', ['events' => $events], ['categories'=> $categories]);
    }
}
