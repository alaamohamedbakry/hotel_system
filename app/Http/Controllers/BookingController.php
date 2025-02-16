<?php

namespace App\Http\Controllers;

use App\Events\BookingEmailSent;
use App\Http\Requests\StoreBookingRequest;
use App\Mail\BookingConfirmation;
use App\Models\Booking;
use App\Models\Guest;
use App\Models\Room;
use App\Models\Roomtype;
use App\Notifications\BookingCreated;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Cast\Bool_;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $bookings = Booking::all();
        $rooms = Room::all();
        $guests = Guest::all();
        return view('admin.tables.booking', compact("bookings", "rooms", "guests"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function admin_create()
    {
        
        $guests = Guest::all();
        $rooms = Room::all();
        return view("admin.forms.booking", compact("guests", "rooms"));
    }
    public function create()
    {
        $guest = Auth::guard('guest-hotel')->user()->id; // الضيف المسجل دخول
        $rooms = Room::all();
        return view('booking', compact("rooms", "guest"));
    }
    public function admin_store(Request $request)
    {
        $request->validate([
            'checkindate' => 'required|date',
            'checkoutdate' => 'required|date',
            'guest_id' => 'required|numeric|exists:guests,id',
            'room_id' => 'required|numeric|exists:rooms,id'
        ]);
        try {
            // التحقق من البيانات المرسلة
            /* $validated = $request->validated();   */
            Booking::create([
                'guest_id' => $request->guest_id,
                'room_id' => $request->room_id,
                'checkindate' => $request->checkindate,
                'checkoutdate' => $request->checkoutdate,
            ]);

            return to_route('booking.index')->with('msg', 'Booking created successfully');
        } catch (Exception $e) {
            return to_route('booking.index')->with('msg', $e->getMessage());
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'checkindate' => 'required|date',
            'checkoutdate' => 'required|date',
            'room_id' => 'required|numeric|exists:rooms,id'
        ]);

        $guest = Auth::guard('guest-hotel')->user(); // جلب بيانات الضيف
        try {
            // إنشاء الحجز
            $booking = Booking::create([
                'room_id' => $request->room_id,
                'checkindate' => $request->checkindate,
                'checkoutdate' => $request->checkoutdate,
                'guest_id' => $guest->id, // ID الضيف المسجل دخول
            ]);

            // إرسال الإشعار عبر البريد الإلكتروني
                $guest = $booking->guest;  // إذا كان الحجز مرتبطًا بـ guest
                $guest->notify(new BookingCreated($booking));
            return to_route('home.index')->with('msg', 'Booking created successfully and email sent.');
        } catch (Exception $e) {
            return to_route('home.index')->with('msg', 'Failed to create booking: ' . $e->getMessage());
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $booking = Booking::with('guest', 'room.roomtype', 'room.hotel')->findOrFail($id);
        return view("admin.booking.show",compact("booking"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
{
    $booking = Booking::findOrFail($id);
    $rooms = Room::all();
    return view('admin.booking.edit', compact("booking", "rooms"));
}

public function update(Request $request, Booking $booking)
{
    $request->validate([
        'checkindate' => 'required|date',
        'checkoutdate' => 'required|date',
        'room_id' => 'required|numeric|exists:rooms,id',
        'guest_id' => 'required|numeric|exists:guests,id'
    ]);

    try {
        // تحديث بيانات الحجز
        $booking->update([
            'room_id' => $request->room_id,
            'checkindate' => $request->checkindate,
            'checkoutdate' => $request->checkoutdate,
            'guest_id' => $request->guest_id, // تأكد من تحديد guest_id بشكل صحيح
        ]);
        return to_route('booking.index')->with('msg', 'Booking updated successfully.');
    } catch (Exception $e) {
        return to_route('booking.index')->with('msg', 'Error updating booking: ' . $e->getMessage());
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        try{
            $booking->delete();
            return to_route('booking.index')->with('msg','booking Deleted successfully');

        }catch(Exception $e){
            return to_route('booking.index')->with('msg',$e->getMessage());

        }

    }

    public function getRoomDetails($id)
    {
        // احصل على الغرفة باستخدام ID
        $room = Room::with('roomtype')->find($id);

        // تحقق إذا كانت الغرفة موجودة
        if ($room) {
            return response()->json([
                'name' => $room->roomtype->name,
                'price' => $room->roomtype->price,
            ]);
        }

        return response()->json(['message' => 'Room not found'], 404);
    }
    //check avilable rooms
    public function avilable_rooms(Request $request, $checkindate)
    {
        try {
            $arooms = DB::table('rooms')
                ->leftJoin('bookings', function ($join) use ($checkindate) {
                    $join->on('rooms.id', '=', 'bookings.room_id')
                        ->where('bookings.checkindate', '<=', $checkindate)
                        ->where('bookings.checkoutdate', '>=', $checkindate);
                })
                ->whereNull('bookings.room_id') // للحصول على الغرف غير المحجوزة فقط
                ->select('rooms.id', 'rooms.room_number')
                ->get();

            return response()->json(['data' => $arooms]);
        } catch (\Exception $e) {
            Log::error("Error in avilable_rooms: " . $e->getMessage());
            return response()->json(['error' => 'حدث خطأ أثناء جلب الغرف المتاحة.'], 500);
        }
    }
}
