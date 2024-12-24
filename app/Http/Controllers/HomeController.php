<?php

namespace App\Http\Controllers;

use App\Models\Hotel;
use App\Models\Room;
use Exception;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function show_tables()
    {
        $hotels= Hotel::all();
        return view('admin.tables.hotel',compact("hotels"));
    }
    public function index()
    {
        $hotels= Hotel::all();
        $rooms=Room::all();
        return view('index',compact("rooms","hotels"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view("admin.forms.hotel");

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required|numeric',
            'email'=>'required|email',
            'star'=>'required|integer|between:1,5',
            'checkin'=>'required|date',
            'checkout'=>'required|date'
        ]);
        try{
            Hotel::create($request->except("_token"));
            return to_route("hotel.show.tables")->with("msg","hotel added successfully");
        }catch(Exception $e){
            return to_route("hotel.show.tables")->with("msg",$e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $hotel = Hotel::findorfail($id);

        return view('admin.hotel.show',compact('hotel')) ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hotel=Hotel::findorfail($id);
        return view('admin.hotel.edit',['hotel'=>$hotel]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hotel $hotel)
    {
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'phone'=>'required|numeric',
            'email'=>'required|email',
            'star'=>'required|integer|between:1,5',
            'checkin'=>'required|date',
            'checkout'=>'required|date'
        ]);
        try{
           $hotel->update($request->except("_token"));
            return to_route("hotel.show.tables")->with("msg","hotel added successfully");
        }catch(Exception $e){
            return to_route("hotel.show.tables")->with("msg",$e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
           $hotel= Hotel::Findorfail($id);
           $hotel->delete();
            return to_route("hotel.show.tables")->with("msg","hotel information deleted successfully!");
        }catch(Exception $e){
            return to_route("hotel.show.tables")->with("msg",$e->getMessage());
        }
    }


    public function about_us(){
        $hotels= Hotel::all();
        return view('about',compact("hotels"));
    }
    
}
