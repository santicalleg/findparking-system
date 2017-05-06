<?php

namespace findparking;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    //
    protected $table = 'color';
	
    protected $fillable = [
        'id', 
        'color_name'
    ];

    public function vehicles()
    {
    	return $this->hasMany(Vehicle::class);
    }
}
