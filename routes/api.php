<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\Venue as VenueResource;
use App\Http\Resources\Event as EventResource;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\Service as ServiceResource;
use App\User;
use App\Venue;
use App\Event;
use App\Category;
use App\Service;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::get('/users', 'UserController@index');
Route::get('/users', function () {
    return UserResource::collection(User::all());
});
Route::get('/venues', function () {
    return VenueResource::collection(Venue::all());
});
Route::get('/events', function () {
    return EventResource::collection(Event::all());
});
Route::get('/categories', function () {
    return CategoryResource::collection(Category::all());
});
Route::get('/services', function () {
    return ServiceResource::collection(Service::all());
});
