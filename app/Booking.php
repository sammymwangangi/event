<?php

namespace App;

use http\Env\Request;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{

//    /**
//     * @var mixed
//     */
//    public $tickets;

    protected $fillable = [
    	'tickets',
        'total',
    	'approved',
    	'event_id',
    	'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function event(){
        return $this->belongsTo(Event::class);
    }

}
