<?php

namespace findparking;

use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    //
    protected $table = 'parking';
    
    protected $fillable = [
        'id', 
        'parking_name', 
        'nit', 
        'phone_number', 
        'latitude', 
        'longitude',
        'address', 
        'services',
        'schedule',
        'administrator_id',
        'price'
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
