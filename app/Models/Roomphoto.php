<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roomphoto extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public Function room(){
        return $this->belongsTo(Room::class);
    }
}
