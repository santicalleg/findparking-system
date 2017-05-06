<?php

namespace findparking;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    //
    protected $table = 'vehicle';
    
    protected $fillable = [
        'id', 
        'last_digit', 
        'color_id', 
        'brand_id', 
        'user_id',
        'vehicle_type_id'
    ];

    public function color()
    {
    	return $this->belongsTo(Color::class);
    }

    public function brand()
    {
    	return $this->belongsTo(Brand::class);
    }

    public function vehicle_type()
    {
    	return $this->belongsTo(Vehicle_Type::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function slots()
    {
        return $this->hasMany(Slot::class);
    }
}
