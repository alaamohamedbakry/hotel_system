<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;
    protected $table = 'hotel';
    protected $guarded = ['id'];
    public function rooms(){
        $this->hasMany(Room::class);
    }
    public function staff(){
        $this->hasMany(staff::class);
    }
}
