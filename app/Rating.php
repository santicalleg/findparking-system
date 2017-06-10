<?php

namespace findparking;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $table = 'rating';
    
    protected $fillable = [
        'id', 
        'value',
        'comment',
        'user_id',
        'parking_id', 
    ];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function parking()
    {
    	return $this->belongsTo(Parking::class);
    }
}
