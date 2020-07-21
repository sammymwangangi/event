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

Route::resource('categories', 'CategoriesController');
Route::resource('events', 'EventsController');
Route::resource('venues', 'VenuesController');
Route::resource('services', 'ServicesController');
Route::get('/search', 'IndexController@search');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
