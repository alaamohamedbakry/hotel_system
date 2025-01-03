<?php

namespace App\Providers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $registrations = Guest::whereDate('created_at', Carbon::today())->count();
        $bookings = Booking::whereDate('created_at', Carbon::today())->count();
        $messages_reviews = Review::latest()->take(5)->get();
        $messages_reviews_count = Review::count();
            $ms = $bookings + $registrations;
    
        // تمرير البيانات لكل الـ Views
        View::share('registrations', $registrations);
        View::share('bookings', $bookings);
        View::share('messages_reviews_count', $messages_reviews_count);
        View::share('messages_reviews', $messages_reviews);
        view::share('ms',$ms);
    }
}
