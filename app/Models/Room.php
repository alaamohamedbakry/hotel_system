<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
   protected $fillable=[
    'room_number',
    'status',
    'image',
    'hotel_id',
    'roomtypes_id'
   ];
    public function hotel()
{
    return $this->belongsTo(Hotel::class,'hotel_id');
}

public function roomtype()
{
    return $this->belongsTo(Roomtype::class,'roomtypes_id');
}

public function booking()
{
    return $this->hasMany(Booking::class);
}

}
