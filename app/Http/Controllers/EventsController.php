<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::latest('starts_at')->get();
        return view('events.index', compact('events'));
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
     * @param \Illuminate\Http\Request $request
     * @param
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'location'=>'required',
            'description'=>'required',
            'entry_fee'=>'required',
            'starts_at'=>'required',
            'ends_at'=>'required',
            'tickets'=>'required',
            'photo' => 'image|max:2000',
        ]);

        // Handle File Upload
        if($request->hasFile('photo')){
            // Get filename with the extension
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('photo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('photo')->storeAs('public/event', $fileNameToStore);

            // make thumbnails
            $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('photo')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/event/'.$thumbStore);

        } else {
            $fileNameToStore = 'car.png';
        }

        $event = new Event();
        $event->name = $request->name;
        $event->location = $request->location;
        $event->entry_fee = $request->entry_fee;
        $event->starts_at = $request->starts_at;
        $event->ends_at = $request->ends_at;
        $event->tickets = $request->tickets;
        $event->description = $request->description;
        $event->venue_id = $request->venue_id;
        $event->photo = $fileNameToStore;
        $event->user_id = Auth::id();
        $event->save();
        $this->syncCategories($event, $request->input('categories'));

        return redirect('events')->with('success', 'Event has been added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $event = Event::find($id);
        return view('events.show', compact('event'));
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
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @param Category $category_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'location'=>'required',
            'description'=>'required',
            'entry_fee'=>'required',
            'starts_at'=>'required',
            'ends_at'=>'required',
            'tickets'=>'required',
            'categories'=>'required'
        ]);
        $event = Event::find($id);

        // Handle File Upload
        if($request->hasFile('photo')){
            // Get filename with the extension
            $filenameWithExt = $request->file('photo')->getClientOriginalName();
            // Get just filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get just ext
            $extension = $request->file('photo')->getClientOriginalExtension();
            // Filename to store
            $fileNameToStore= $filename.'_'.time().'.'.$extension;
            // Upload Image
            $path = $request->file('photo')->storeAs('public/event', $fileNameToStore);
            Storage::delete('public/event/'.$event->photo);

            // make thumbnails
            $thumbStore = 'thumb.'.$filename.'_'.time().'.'.$extension;
            $thumb = Image::make($request->file('photo')->getRealPath());
            $thumb->resize(80, 80);
            $thumb->save('storage/event/'.$thumbStore);

        }

        $event->name = $request->input('name');
        $event->location = $request->input('location');
        $event->entry_fee = $request->input('entry_fee');
        $event->starts_at = $request->input('starts_at');
        $event->ends_at = $request->input('ends_at');
        $event->tickets = $request->input('tickets');
        $event->description = $request->input('description');
        $event->venue_id = $request->input('venue_id');
        $event->user_id = Auth::id();
        if($request->hasFile('photo')){
            $event->photo = $fileNameToStore;
        }
        $event->save();
        $this->syncCategories($event, $request->input('categories'));

        return redirect('events')->with('success', 'Event has been updated successfully!');
    }

    public function syncCategories(Event $event, $categories){
        $event->categories()->sync((array)$categories);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        $event->delete();
        return redirect('/events')->with('success', 'Event has been successfully Removed!');
    }
}
