<?php

namespace findparking;

use Illuminate\Database\Eloquent\Model;

class Park extends Model
{
    //
    protected $table = 'park';

    protected $fillable = [
    	'id',
    	'user_id',
    	'vehicle_id',
    	'parking_id'
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function vehicle()
    {
    	return $this->belongsTo(Vehicle::class);
    }

    public function parking()
    {
    	return $this->belongsTo(Parking::class);
    }
}
