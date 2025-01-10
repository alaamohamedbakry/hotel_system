<?php
namespace App\Notifications;

use App\Channels\SmsChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class BookingCreated extends Notification
{
    use Queueable;
    private $booking;

    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    // تحديد القنوات التي سيتم إرسال الإشعار عبرها
    public function via(object $notifiable): array
    {
        return ['mail'];  
    }

    // طريقة البريد الإلكتروني
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Booking Created')
            ->line('Your booking has been created successfully.')
            ->action('View Booking', url('/booking/' . $this->booking->id));
    }

    
    // طريقة تحويل الإشعار إلى مصفوفة
    public function toArray(object $notifiable): array
    {
        return [];
    }
}
