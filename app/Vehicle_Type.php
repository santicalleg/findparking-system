<?php

namespace findparking;

use Illuminate\Database\Eloquent\Model;

class Vehicle_Type extends Model
{
    //
    protected $table = 'vehicle_type';
    protected $primaryKey = 'vehicle_type_id';
    
    protected $fillable = [
        'vehicle_type_id', 
        'vehicle_type_name'
    ];

    public function vehicles()
    {
    	return $this->hasMany(Vehicle::class);
    }
}
