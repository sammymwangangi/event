<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{

    protected $fillable = [
      'name',
      'description',
      'amount',
      'starts_at',
      'ends_at',
      'photo',
      'tickets_left',
      'location',
      'user_id',
      'venue_id'
    ];


    public function user(){
        return $this->belongsTo('App\User');
    }
    public function venue(){
        return $this->belongsTo('App\Venue');
    }

    /**
     * The categories that belong to the event.
     */
    public function categories(){
        return $this->belongsToMany('App\Category', 'category_event', 'event_id', 'category_id');
    }
    public function bookings(){
        return $this->hasMany('App\Booking');
    }
}
