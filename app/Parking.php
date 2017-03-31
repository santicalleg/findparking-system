<?php

namespace findparking;

use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    //
    protected $fillable = [
        'parking_id', 
        'parking_username', 
        'nit', 'phone_number', 
        'latitude', 
        'longitude', 
        'address', 
        'administrator_id'
    ];

    public function administrator()
    {
        return $this->belongsTo(Administrator::class);
    }

    public function slots()
    {
        return $this->hasMany(Slot::class);
    }
}
