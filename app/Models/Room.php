<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'room_number',
        'status',
        'image',
        'hotel_id',
        'roomtypes_id',
    ];

    // الحالات المسموحة
    public static $statuses = ['empty', 'busy', 'maintenance'];

    public Function roomphoto(){
        return $this->Hasmany(Room::class);
    }
    public function hotel(){
      return  $this->belongsto(Hotel::class);
    }
    public function bookings(){
        return   $this->hasMany(Booking::class);
    }
    public function roomtype(){
        return  $this->belongsto(Roomtype::class,'roomtypes_id');
      }
}
