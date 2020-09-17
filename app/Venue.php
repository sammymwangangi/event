<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = [
        'name',
        'price',
        'address',
        'seats',
        'image',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function events()
    {
        return $this->hasMany('App\Event');
    }

    public function venue_bookings(){
        return $this->hasMany('App\VenueBooking');
    }
}
