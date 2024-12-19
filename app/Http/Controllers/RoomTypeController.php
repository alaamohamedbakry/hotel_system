<?php

namespace App\Http\Controllers;

use App\Models\Roomtype;
use Exception;
use Illuminate\Http\Request;

class RoomTypeController extends Controller
{

    public function index()
    {
        $roomtypes = Roomtype::all();
        return view('admin.tables.roomtype',compact('roomtypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.forms.roomtype');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'pricepernight' => 'required',
            'capacity' => 'required',
        ]);
         try{
          $roomtype= new Roomtype();
          $roomtype->name = $request->name;
          $roomtype->description = $request->description;
          $roomtype->pricepernight = $request->pricepernight;
          $roomtype->capacity = $request->capacity;
          $roomtype->save();
           return to_route('roomtype.index')->with('msg','roomtype added successfully');
        }catch(Exception $e){
            return to_route('roomtype.index')->with('msg',$e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roomtype = Roomtype::findOrFail($id);
        return view('admin.roomtypes.edit', compact('roomtype'));
    }

    // تحديث نوع الغرفة
    public function update(Request $request, Roomtype $roomtype)
    {
        $request->validate([
            'name' => 'required|max:100',
            'description' => 'required',
            'pricepernight' => 'required|numeric|min:0',
            'capacity' => 'required|integer|min:1',
        ]);

        try {
            // التحديث مباشرة باستخدام `update`
            $roomtype->update($request->only(['name', 'description', 'pricepernight', 'capacity']));

            return to_route('roomtype.index')->with('msg', 'Roomtype updated successfully');
        } catch (Exception $e) {
            return to_route('roomtype.index')->with('error', 'Failed to update Roomtype: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
          Roomtype::destroy($id);
          return to_route('roomtype.index')->with('msg','roomtype deleted successfully');

        }catch(Exception $e){
            return to_route('roomtype.index')->with('msg',$e->getMessage());

        }
    }
}
