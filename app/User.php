<?php

namespace findparking;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $primaryKey = 'user_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'username', 
        'first_name', 
        'last_name', 
        'email', 
        'mobile_number', 
        'password_hash'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password_hash', 'remember_token',
    ];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
