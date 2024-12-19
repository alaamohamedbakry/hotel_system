<?php

namespace App\Models;

 //use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Staff extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public function hotel(){
        $this->hasOne(Hotel::class);
    }


     /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'staff';
    protected $fillable = [
        'First_name',
        'Last_name',
        'position',
        'salary',
        'DateOfBirth',
        'phone',
        'email',
        'password',
        'hire_date',
        'hotel_id'
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

}
