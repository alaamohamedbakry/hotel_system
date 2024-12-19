<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roomtype extends Model
{
    use HasFactory;
    protected $table = 'roomtypes';
    protected $fillable=['name','description','pricepernight','capacity'];
    public function rooms(){
      return  $this->hasMany(Room::class);
    }
}
