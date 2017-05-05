<?php

namespace findparking;

use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    //
    protected $table = 'slot';
    protected $primaryKey = 'slot_id';

    protected $fillable = [
        'slot_id', 
        'name', 
        'vehicle_id', 
        'parking_id'
    ];

    public function vehicle()
    {
    	return $this->belongsTo(Vehicle::class);
    }

    public function parking()
    {
    	return $this->belongsTo(Parking::class);
    }
}
