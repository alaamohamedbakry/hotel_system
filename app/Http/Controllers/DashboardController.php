<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Guest;
use App\Models\Hotel;
use App\Models\Review;
use App\Models\Room;
use App\Models\Staff;
use App\Notifications\GuestsNotifications;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
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


    public function chart_staff(){
        try{
            $staff=Staff::select('hotel_id',DB::raw('count(*) as total'))
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
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function total_bookings(){
        $total_booking=Booking::count();
        return response()->json(['data'=>$total_booking]);
    }
    public function total_rooms(){
        $total_rooms=Room::count();
        return response()->json(['data'=>$total_rooms]);
    }
    public function total_user(){
        $total_user=Guest::count();
        return response()->json(['data'=>$total_user]);
    }
    public function total_hotels(){
        $total_hotels=Hotel::count();
        return response()->json(['data'=>$total_hotels]);
    }
    public function inbox(){
        $reviews=Review::all();
        return view('admin.inbox',compact('reviews'));
    }
    public function send_email($id){
        $review=Review::find($id);
        return view('admin.send_email',compact('review'));
    }

    public function mail(Request $request, $id)
    {
        $review = Review::findOrFail($id); // استخدم findOrFail لضمان العثور على السجل
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
    

}
