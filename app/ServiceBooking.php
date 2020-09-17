<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceBooking extends Model
{
    protected $fillable = [
        'service_id',
        'user_id'
    ];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function service(){
        return $this->belongsTo(Service::class);
    }
}
