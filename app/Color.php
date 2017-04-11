<?php

namespace findparking;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    //
    protected $table = 'color';
	protected $primaryKey = 'color_id';

    protected $fillable = [
        'color_id', 
        'color_name'
    ];

    public function vehicles()
    {
    	return $this->hasMany(Vehicle::class);
    }
}
