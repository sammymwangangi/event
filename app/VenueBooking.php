<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VenueBooking extends Model
{
    protected $fillable = [
        'venue_id',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function venue(){
        return $this->belongsTo(Venue::class);
    }
}
