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

	public function getByUserAndParking($parking_id)
	{
		$rating = $this->findByUserAndParking(Auth::user()->id, $parking_id);
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
            'parking_id' => 'required|min:1'
		]);

    	$user = Auth::user();

    	$data = $request->all();
    	$rating = new Rating($data);
    	$rating->user_id = $user->id;

    	//validate if already exists an rating from the current user,
    	//updates the last rating from sended parking.
    	$foundRating = $this->findByUserAndParking($user->id, $rating->parking_id);

    	if (!empty($foundRating))
    	{
    		$foundRating->value = $rating->value;
    		$foundRating->comment = $rating->comment;
    		$rating = $foundRating;
    	}

    	$rating->save();

		$avg = $this->updateRating($rating->parking_id);

		$json = $this->buildRatingResponse($rating, $avg);
		$result = json_encode($json);
		return $result;
    }

    public function update(Request $request)
    {
    	$this->validate($request, [
    		'id' => 'required|min:1',
			'value' => 'required|min:1',
            'parking_id' => 'required|min:1'
		]);

		$user = Auth::user();
		$rating = Rating::find($request->input('id'));

		//validate if the authenticated user is the rating owner
		if ($user->id !== $rating->user_id)
		{
			return response(
				'No está autorizado para actualizar las califcaciones de otros usuarios', 
				403
			);
		}

		$rating->value = $request->input('value');
		$rating->comment = $request->input('comment');

		$rating->save();

		$avg = $this->updateRating($rating->parking_id);

		$json = $this->buildRatingResponse($rating, $avg);
		$result = json_encode($json);
		return $result;
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

		return $avg;
	}

	private function buildRatingResponse($rating, $avg)
	{
		$result = (object) [
			'id' => $rating->id, 
			'value' => $rating->value, 
			'comment' => $rating->comment, 
			'user_id' => $rating->user_id, 
			'parking_id' => $rating->parking_id,
			'avg' => $avg
		];

		return $result;
	}

	private function findByUserAndParking($user_id, $parking_id)
	{
		$rating = Rating::where('user_id', $user_id)
					->where('parking_id', $parking_id)
					->first();

		return $rating;
	}
}
