<?php

namespace App\Providers;

use App\Category;
use App\Event;
use App\Service;
use App\Venue;
use App\Booking;
use View;
use App\Observers\BookingObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Booking::observe(BookingObserver::class);
        View::share('events', Event::all());
        View::share('venues', Venue::all());
        View::share('services', Service::all());
        View::share('categories', Category::all());
        View::share('bookings', Booking::all());
    }
}
