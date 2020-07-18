<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    /**
     * The events that belong to the category.
     */
    public function events(){
        return $this->belongsToMany('App\Event');
    }
}
