<?php

namespace findparking\Http\Controllers;

use Session;
use Exception;
use findparking\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
	public function get($id)
	{
		$rating = Rating::find($id);

		return $rating->toJson();
	}

    public function store(Request $request)
    {
    	$this->validate($request, [
			'value' => 'required|min:1',
            'parking_id' => 'max:6'
		]);

    	$user = Auth::user();

    	$data = $request->all();
    	$rating = new Rating($data);
    	$rating->user_id = $user->id;

    	//TODO: Calculate avg parking rating

    	$rating->save();

    	return $rating->toJson();
    }

    public function update(Request $request)
    {
    	$this->validate($request, [
    		'id' => 'required|min:1',
			'value' => 'required|min:1',
            'parking_id' => 'max:6'
		]);

		$user = Auth::user();
		$data = $request->all();
		$rating = Rating::find($data->id);

		//TODO: validate if the authenticated user is the rating owner
		$rating->value = $data->value;
		$rating->comment = $data->comment;

		//TODO: Calculate avg parking rating

		$rating->save();

		return $rating->toJson();
    }
}
