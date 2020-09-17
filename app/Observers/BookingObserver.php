<?php

namespace App\Observers;

use App\Booking;
use App\Event;

class BookingObserver
{
//    public function creating(Booking $booking){
//        $events = Event::all();
//        $booking->total = $event->entry_fee * $booking->tickets;
//        $booking->total = $events->sum(function ($event){
//            return $event->entry_fee * $event->tickets;
//        });
//    }
    /**
     * Handle the event "created" event.
     *
     * @param  Booking  $booking
     * @return void
     */
    public function created(Booking $booking)
    {

        $event = Event::find($booking->event_id);
        if ($event) {
            $event->decrement('tickets_left', $booking->tickets);
            return $event->entry_fee;
        }
    }

    /**
     * Handle the post "saving" event.
     *
     * @param Booking $booking
//     * @param Event $event
     * @return void
     */
    public function saving(Booking $booking)
    {
//        $post->slug = str_slug($post->title);
//        $booking->total = $event->entry_fee * $booking->tickets;
    }
}
