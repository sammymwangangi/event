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


// Route::resources([
//     'categories' => 'CategoriesController',
//     'events' => 'EventsController',
//     'bookings' => 'BookingsController',
//     'venues' => 'VenuesController',
//     'services' => 'ServicesController',
// ]);

//Route::get('/{any}', 'UserController@index')->where('any', '.*');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('categories', 'CategoriesController');
Route::resource('events', 'EventsController');
Route::resource('bookings', 'BookingsController');
Route::resource('venues', 'VenuesController');
Route::resource('services', 'ServicesController');
Route::resource('expenses', 'ExpenseController');
Route::post('rent', 'BookingsController@book_venue')->name('book_venue');
Route::post('booking', 'BookingsController@book_service')->name('book_service');
Route::get('/search', 'IndexController@search');

Route::get('changeStatus', 'DashboardController@ChangeBookingStatus');
Route::get('changeVenueStatus', 'DashboardController@ChangeVenueBookingStatus');
// Route::get('changeStatus', 'DashboardController@ChangeBookingStatus');

// DASHBOARD
// 

Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
Route::get('dashboard/expenses', 'ExpenseController@index')->name('dashboard.expenses');
Route::get('dashboard/print-bookings','DashboardController@print_bookings');
Route::get('dashboard/print-expenses','ExpenseController@print_expenses');


