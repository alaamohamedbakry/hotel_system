<?php

namespace App\Listeners;

use App\Events\BookingEmailSent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogBookingEmailSent
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(BookingEmailSent $event)
    {
        Log::info('Booking email status: ' . $event->status);
    }
}
