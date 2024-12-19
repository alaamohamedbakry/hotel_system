<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\Roomtype;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show_tables()
    {
        $rooms= Room::all();
        $hotel =Hotel::all();
        $roomtype=Roomtype::all();
        return view('admin.tables.room',compact("rooms","hotel","roomtype"));
    }
    public function index(Request $request)
    {
        $hotels = Hotel::all();
        $rooms = Room::query();

        if ($request->has('search') && $request->search != '') {
            $rooms->where('room_number', 'like', '%' . $request->search . '%')
                  ->orWhereHas('roomtype', function ($query) use ($request) {
                      $query->where('name', 'like', '%' . $request->search . '%');
                  });
        }

        // الحصول على النتائج كـ Collection
        $rooms = Room::paginate(5);
        return view('room', ['rooms' => $rooms, 'hotels' => $hotels]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $room = new Room();
        $hotels = Hotel::all();
        $roomtype = Roomtype::all();

        return view('admin.forms.rooms', compact('hotels', 'roomtype', 'room'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_number'=>'required',
            'status'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hotel_id'=>'required|numeric|exists:hotel,id',
            'roomtypes_id'=>'required|numeric|exists:roomtypes,id'
        ]);
        try {

            Room::create([
                'image' => $request->file('image')->store('room_image', 'public'),
                'room_number' => $request->room_number,
                'status' => $request->status,
                'description' => $request->description,
                'hotel_id' => $request->hotel_id,
                'roomtypes_id' => $request->roomtypes_id
            ]);
            return to_route('rooms.show.tables')->with('msg', 'Room added successfully.');
        } catch (Exception $e) {
            return to_route('rooms.show.tables')->with('msg', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hotel=Hotel::all();
        $roomtype=Roomtype::all();
        $room = Room::findorfail($id);
        return view('rooms.show',compact('hotel','roomtype')) ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $room = Room::findOrFail($id);
        $hotels=Hotel::all();
        $roomtype=Roomtype::all();
        return view('admin.rooms.edit',compact('hotels', 'roomtype', 'room'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Room $room)
    {
        $request->validate([
            'room_number'=>'required',
            'status'=>'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hotel_id'=>'required|numeric|exists:hotel,id',
            'roomtypes_id'=>'required|numeric|exists:roomtypes,id'
        ]);
        try {
            $room->update($request->except('_token', 'image'));
            if ($request->hasFile('image')) {
                // حذف الصورة القديمة إذا كانت موجودة
                if ($room->image && Storage::exists($room->image)) {
                    Storage::delete($room->image);
                }

                // رفع الصورة الجديدة وتحديث مسارها
                $room->image = Storage::put('room_image', $request->file('image'));

                // حفظ مسار الصورة الجديد
                $room->save();
            }
            return to_route('rooms.show.tables')->with('msg', 'Room updated successfully.');
        } catch (Exception $a) {
            return to_route('rooms.show.tables')->with('msg', $a->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Room $room)
    {
        try {
            if ($room->image) Storage::delete($room->image);
            $room->delete();
            return to_route('rooms.show.tables')->with('msg', 'Room deleted');
        } catch (Exception $a) {
            return to_route('rooms.show.tables')->with('msg', $a->getMessage());
        }
    }



    public function getRoomDetails($room_id)
{
    $room = Room::with('roomType')->find($room_id);

    if ($room) {
        return response()->json([
            'name' => $room->roomType->name,
            'price' => $room->roomType->pricepernight,
        ]);
    }

    return response()->json(['error' => 'Room not found'], 404);
}

}
