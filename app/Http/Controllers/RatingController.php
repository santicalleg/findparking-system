<?php

namespace findparking\Http\Controllers;

use Log;
use Session;
use Exception;
use findparking\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
	public function get($id)
	{
		$rating = Rating::find($id);

		return $rating->toJson();
	}

	public function getByUser() 
	{
		$rating = Rating::where('user_id', Auth::user()->id)
					->firstOrFail();
		if ($rating) 
		{
			Log::info('rating not empty');
			Log::info($rating->comment);
		}
		else 
		{
			Log::info('rating empty');
		}

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

    	$rating->save();

		updateRating($data->parking_id);

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

		$rating->save();

		updateRating($data->parking_id);

		return $rating->toJson();
    }

	private function updateRating($parking_id)
	{
		//Calculate avg parking rating
		$avg = DB::table('rating')
						->where('parking_id', $parking_id)
						->avg('value');

		$parking = Parking::find($id);

		$parking->rating = $avg;

		$parking->save();
	}
}
