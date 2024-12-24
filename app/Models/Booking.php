<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';
    protected $fillable = [
        'guest_id',
        'room_id',
        'checkindate',
        'checkoutdate',
    ];

    public function guest(){
      return  $this->belongsTo(guest::class,'guest_id');
    }
    public function room(){
      return   $this->belongsTo(Room::class,'room_id');
    }
    public function payment(){
      return  $this->hasMany(payment::class);
    }




    protected static function boot()
  {
    parent::boot();

    static::saving(function ($booking) {
        $room = $booking->room;
        $room->update(['status' => 'busy']);
    });

    static::deleting(function ($booking) {
        $room = $booking->room;
        if (!$room->bookings()->exists()) {
            $room->update(['status' => 'empty']);
        }
    });
  }

}
