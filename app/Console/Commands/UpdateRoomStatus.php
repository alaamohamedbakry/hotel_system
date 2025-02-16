<?php

namespace App\Console\Commands;

use App\Models\ArchivedBooking;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Console\Command;

class UpdateRoomStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rooms:update-status';
    protected $description = 'Update room status to empty when booking check-out time is over';

    /**
     * The console command description.
     *
     * @var string
     */

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // جلب الحجوزات التي انتهى وقت تسجيل خروجها
        $bookings = Booking::where('checkoutdate', '<', Carbon::today())->get();

        foreach ($bookings as $booking) {
            // نقل بيانات الحجز إلى جدول الأرشيف
            ArchivedBooking::create([
                'room_id' => $booking->room_id,
                'guest_id' => $booking->guest_id,
                'checkindate' => $booking->checkindate,
                'checkoutdate' => $booking->checkoutdate,
                'created_at' => $booking->created_at,
                'updated_at' => $booking->updated_at,
            ]);

            // تحديث حالة الغرفة إلى empty
            $booking->room->update(['status' => 'empty']);

            // حذف الحجز من الجدول الأساسي
            $booking->delete();
        }

        $this->info("Expired bookings moved to archive and rooms updated to empty.");
    }
}
