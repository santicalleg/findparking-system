<?php

namespace findparking;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    //
    protected $table = 'slot';
    
    protected $fillable = [
        'id', 
        'slot_name', 
        'vehicle_id', 
        'parking_id',
        'vehicle_type_id'
    ];

    public function parking()
    {
    	return $this->belongsTo(Parking::class);
    }

    public function vehicle_type()
    {
        return $this->belongsTo(Vehicle_Type::class);
    }
}
