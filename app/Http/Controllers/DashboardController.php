<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Hotel;
use App\Models\Review;
use App\Models\Room;
use App\Models\Staff;
use App\Notifications\GuestsNotifications;
use App\Notifications\UsersNotifications;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function login_admin()
    {
        return view('admin.login');
    }
    public function register_admin()
    {
        return view('admin.register');
    }
    public function index()
    {
        return view('admin.dashboard');
    }
    public function admin_index()
    {
        return view('admin.index');
    }

    public function chart_bookings()
    {
        try {
            $bookings = Booking::selectRaw('count(id) as total_bookings, checkindate')
                ->groupBy('checkindate')
                ->get();

            $labels = $bookings->pluck('checkindate');
            $data = $bookings->pluck('total_bookings');

            return response()->json([
                'labels' => $labels,
                'data' => $data,
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function chart_rooms()
    {
        try {
            // جلب الغرف مع اسم الفندق المرتبط بكل غرفة
            $rooms = Room::select('room_number', 'hotel_id') // افترضنا أن الفندق مرتبط بـ 'hotel_id'
                ->with('hotel:id,name') // هنا نفرض أن هناك علاقة مع نموذج Hotel للحصول على اسم الفندق
                ->get();

            // تجميع البيانات بحيث يكون كل فندق يحتوي على عدد الغرف
            $roomCounts = $rooms->groupBy('hotel_id')->map(function ($items) {
                return count($items); // عدّ الغرف في كل فندق
            });

            // تجهيز البيانات للـ Pie Chart
            $labels = [];
            $data = [];

            foreach ($roomCounts as $hotel_id => $count) {
                $hotel = Hotel::find($hotel_id); // الحصول على اسم الفندق من الـ hotel_id
                if ($hotel) {
                    $labels[] = $hotel->name; // إضافة اسم الفندق
                    $data[] = $count; // إضافة عدد الغرف
                }
            }

            return response()->json([
                'labels' => $labels,
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function chart_staff()
    {
        try {
            $staff = Staff::select('hotel_id', DB::raw('count(*) as total'))
                ->groupby('hotel_id')
                ->get();
            $labels = $staff->map(function ($staff) {
                return Hotel::find($staff->hotel_id)->name;
            });

            $data = $staff->pluck('total');

            return response()->json([
                'labels' => $labels,
                'data' => $data
            ]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function total_bookings()
    {
        $total_booking = Booking::count();
        return response()->json(['data' => $total_booking]);
    }
    public function total_rooms()
    {
        $total_rooms = Room::count();
        return response()->json(['data' => $total_rooms]);
    }
    public function total_user()
    {
        $total_user = Guest::count();
        return response()->json(['data' => $total_user]);
    }
    public function total_hotels()
    {
        $total_hotels = Hotel::count();
        return response()->json(['data' => $total_hotels]);
    }
    public function inbox()
    {
        $reviews = Review::all();
        return view('admin.inbox', compact('reviews'));
    }
    public function send_email($id)
    {
        $review = Review::find($id);
        return view('admin.send_email', compact('review'));
    }


    public function mail(Request $request, $id)
    {
        $review = Review::findOrFail($id);
        $details = [
            'greeting' => $request->greeting,
            'mail_body' => $request->mail_body,
            'action_text' => $request->action_text,
            'action_url' => $request->action_url,
            'end_line' => $request->end_line
        ];

        // إرسال الإشعار
        $review->notify(new GuestsNotifications($details));

        return redirect()->route('inbox')->with('msg', 'Email Sent Successfully');
    }
    public function notifications()
    {
        $registrations = Guest::whereDate('created_at', Carbon::today())->count();
        $bookings = Booking::whereDate('created_at', Carbon::today())->count();
        $booking_count = Booking::count();
        $guest_count = Guest::count();
        $ms = $booking_count + $guest_count;

        return view('admin.dashboard', compact('registrations', 'bookings', 'ms'));
    }
    public function messages()
    {
        // استرجاع آخر 5 مراجعات
        $messages_reviews = Review::latest()->take(5)->get();

        // تحقق من المراجعات قبل تمريرها إلى الـ View
        dd($messages_reviews); // هذا سيطبع المتغير ويساعدك في تحديد إذا كان فارغًا أو لا

        return view('admin.dashboard', compact('messages_reviews'));
    }

    public function show_tables()
    {
        $guests = Guest::latest()->get();
        return view('admin.tables.guests', compact('guests'));
    }

    public function email_sending($id)
    {
        $guest = Guest::find($id);
        return view('admin.send_email_guests', compact('guest'));
    }

    public function mailing(Request $request, $id)
    {
        $guest = Guest::findOrFail($id);
        $messages = [
            'greeting' => $request->greeting,
            'mail_body' => $request->mail_body,
            'action_text' => $request->action_text,
            'action_url' => $request->action_url,
            'end_line' => $request->end_line
        ];

        // إرسال الإشعار
        $guest->notify(new UsersNotifications($messages));

        return redirect()->route('guests.show.tables')->with('msg', 'Email Sent Successfully');
    }


    public function create_guest()
    {
        return view('admin.forms.guests');
    }
    public function store_guest(Request $request)
    {
        // التحقق من صحة البيانات
        $validated = $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'DateOfBirth' => 'required|date',
            'Address' => 'required|string|max:500',
            'Phone' => 'required|string|max:20',
            'email' => 'required|email|max:255|unique:guests,email', // تأكد من أن البريد غير مكرر
            'password' => 'required|string|min:6|confirmed',
        ]);

        // تخزين البيانات الجديدة
        Guest::create([
            'FirstName' => $validated['FirstName'],
            'LastName' => $validated['LastName'],
            'DateOfBirth' => $validated['DateOfBirth'],
            'Address' => $validated['Address'],
            'Phone' => $validated['Phone'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
        ]);

        return redirect()->route('guests.show.tables')->with('success', 'Guest created successfully!');
    }

    public function edit_guest($id)
    {
        $guest = Guest::find($id);
        return view('admin.guests.edit', compact('guest'));
    }

    public function update_guest(Request $request, Guest $guest)
    {
        // التحقق من صحة البيانات
        $validated = $request->validate([
            'FirstName' => 'required|string|max:255',
            'LastName' => 'required|string|max:255',
            'DateOfBirth' => 'required|date',
            'Address' => 'required|string|max:500',
            'Phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'password' => 'nullable|string|min:6|confirmed', // إذا كانت هناك حاجة لتغيير كلمة المرور
        ]);

        // تحديث البيانات
        $guest->update([
            'FirstName' => $validated['FirstName'],
            'LastName' => $validated['LastName'],
            'DateOfBirth' => $validated['DateOfBirth'],
            'Address' => $validated['Address'],
            'Phone' => $validated['Phone'],
            'email' => $validated['email'],
            'password' => $request->filled('password') ? bcrypt($validated['password']) : $guest->password, // لا تغيير إذا لم تكن كلمة المرور مدخلة
        ]);

        return redirect()->route('guests.show.tables')->with('success', 'Guest updated successfully!');
    }


    public function destroy(Guest $guest)
    {
        try {
            $guest->delete();
            return to_route('guests.show.tables')->with('msg', 'Guest Deleted Successfully');
        } catch (Exception $e) {
            return to_route('guests.show.tables')->with('msg', $e->getMessage());
        }
    }
}
