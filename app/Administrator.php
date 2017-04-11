<?php

namespace findparking;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    //
    protected $table = 'administrator';
    protected $primaryKey = 'administrator_id';

    protected $fillable = [
        'administrator_id', 
        'administrator_username', 
        'administrator_email',
        'password_hash', 
        'administrator_first_name', 
        'administrator_last_name'
    ];

    public function parkings() 
    {
    	return $this->hasMany(Parking::class);
    }
}
