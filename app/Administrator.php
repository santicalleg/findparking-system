<?php

namespace findparking;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    //

    protected $fillable = [
        'administrator_id', 
        'administrator_username', 
        'password_hash', 
        'administrator_first_name', 
        'administrator_last_name'
    ];

    public function parkings() 
    {
    	return $this->hasMany(Parking::class);
    }
}
