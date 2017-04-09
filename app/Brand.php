<?php

namespace findparking;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    //
	protected $table = 'brand';

    protected $fillable = [
        'brand_id', 
        'brand_name'
    ];

    public function vehicles()
    {
    	return $this->hasMany(Vehicle::class);
    }
}