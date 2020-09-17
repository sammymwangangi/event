<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'price',
        'description',
        'avatar',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function service_bookings(){
        return $this->hasMany('App\ServiceBooking');
    }
}
