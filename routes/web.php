<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'IndexController@index');


Route::resources([
    'categories' => 'CategoriesController',
    'events' => 'EventsController',
    'bookings' => 'BookingsController',
    'venues' => 'VenuesController',
    'services' => 'ServicesController',
]);
Route::post('bookings', 'BookingsController@book_venue')->name('bookings.book_venue');
Route::post('bookings', 'BookingsController@book_service')->name('bookings.book_service');
Route::get('/search', 'IndexController@search');


//Route::get('/{any}', 'UserController@index')->where('any', '.*');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
