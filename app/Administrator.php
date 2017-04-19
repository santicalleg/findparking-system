<?php

namespace findparking;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Administrator extends Authenticatable
{
    use Notifiable;

    protected $table = 'administrator';
    protected $primaryKey = 'administrator_id';

    protected $fillable = [
        'administrator_id', 
        'administrator_first_name', 
        'administrator_last_name',
        'name',
        'email',
        'password' 
    ];

    protected $hidden = [
        'password'
    ];

    public function parkings() 
    {
    	return $this->hasMany(Parking::class);
    }
}
