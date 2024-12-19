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
}