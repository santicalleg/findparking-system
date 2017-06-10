<?php

namespace findparking\Http\Controllers;

use Log;
use Session;
use Exception;
use findparking\Rating;
use findparking\Parking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
					->first();
		if (!$rating) 
		{
			//Log::info('rating not empty');
			$rating = new Rating;
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

		$this->updateRating($rating->parking_id);

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
		$rating = Rating::find($request->input('id'));

		//TODO: validate if the authenticated user is the rating owner
		$rating->value = $request->input('value');
		$rating->comment = $request->input('comment');

		$rating->save();

		$this->updateRating($rating->parking_id);

		return $rating->toJson();
    }

	private function updateRating($parking_id)
	{
		Log::info('updateRating');
		//Calculate avg parking rating
		$avg = DB::table('rating')
						->where('parking_id', $parking_id)
						->avg('value');

		$parking = Parking::find($parking_id);

		$parking->rating = $avg;

		$parking->save();
	}
}
