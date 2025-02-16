<?php

namespace App\Models;

 //use Illuminate\Contracts\Auth\MustVerifyEmail;

 use Illuminate\Database\Eloquent\Factories\HasFactory;
 use Illuminate\Foundation\Auth\User as Authenticatable;
 use Illuminate\Notifications\Notifiable;
 use Laravel\Sanctum\HasApiTokens;;

class Guest extends Authenticatable
{
   
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'guests';
    public function booking() {
        return $this->hasMany(Booking::class);
    }
    
    protected $fillable = [
        'FirstName',
        'LastName',
        'DateOfBirth',
        'Address',
        'Phone',
        'email',
        'password'
    ];
  /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function bookings(){
        $this->hasMany(booking::class);
    }
}
