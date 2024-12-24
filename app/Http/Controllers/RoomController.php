<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use App\Models\Roomphoto;
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
        $hotels = Hotel::all();
        $roomtype = Roomtype::all();

        return view('admin.forms.rooms', compact('hotels', 'roomtype'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'room_number'=>'required',
            'status' => 'required|in:empty,busy,maintenance', // التحقق من الحالة
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
public function addroomimages(Request $request, $roomid)
{
    $room = Room::findOrFail($roomid);

    // الحصول على الصور المخزنة
    $roomimages = Roomphoto::where('room_id', $room->id)->get();

    return view('admin.rooms.addphotos', [
        'roomimages' => $roomimages,
        'room' => $room
    ]);
}

    public function removeroomphotos(Roomphoto $roomphoto)
{
    try {
        if ($roomphoto->photopath) Storage::delete($roomphoto->photopath);
        $roomphoto->delete();
        return to_route('rooms.show.tables')->with('msg', 'productphoto deleted');
    } catch (Exception $a) {
        return to_route('rooms.show.tables')->with('msg', $a->getMessage());
    }
}

public function storeroomimage(Request $request)
{
    $request->validate([
        'image' => 'required|image',
        'room_id' => 'required|numeric|exists:rooms,id'
    ]);

    try {
        $photopath = $request->file('image')->store('room_image', 'public');

        Roomphoto::create([
            'photopath' => $photopath,
            'room_id' => $request->room_id
        ]);

        // بعد حفظ الصورة بنجاح، نعيد التوجيه إلى الصفحة المناسبة
        return redirect()->route('addroomimage', ['roomid' => $request->room_id])
                         ->with('msg', 'Product added successfully.');
    } catch (Exception $e) {
        return redirect()->route('addroomimage', ['roomid' => $request->room_id])
                         ->with('msg', $e->getMessage());
    }
}


public function updateStatus(Request $request, $id)
{
    $room = Room::findOrFail($id);

    $request->validate([
        'status' => 'required|in:empty,busy,maintenance',
    ]);

    $room->update(['status' => $request->status]);

    return back()->with('msg', 'Room status updated successfully.');
}


}
