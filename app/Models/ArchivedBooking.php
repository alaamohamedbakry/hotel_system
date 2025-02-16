<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArchivedBooking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'guest_id',
        'checkindate',
        'checkoutdate',
    ];
}
