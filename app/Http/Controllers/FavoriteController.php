<?php

namespace findparking\Http\Controllers;

use Log;
use Exception;
use findparking\Rating;
use findparking\Parking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    //
    public function index() {

        $parkings = Parking::whereHas('ratings', function ($query) {
            $user = Auth::user();
            $query->where('user_id', $user->id)->where('isFavorite', 1);
        })->paginate(10);

        return view('favorite/index', compact('parkings'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'isFavorite' => 'required',
            'parking_id' => 'required|min:1'
        ]);

        $user = Auth::user();

        $rating = new Rating;
        $rating->value = 0;
        $rating->isFavorite = $request->input('isFavorite');
        $rating->parking_id = $request->input('parking_id');
        $rating->user_id = $user->id;

        //validate if already exists an rating from the current user,
        //updates the last rating from sended parking.
        $foundRating = $this->findByUserAndParking($user->id, $rating->parking_id);

        if (!empty($foundRating))
        {
            $foundRating->isFavorite = $rating->isFavorite;
            $rating = $foundRating;
        }

        $rating->save();

        return ($rating->isFavorite) ? 1 : 0;
    }

    public function update(Request $request, $id) 
    {
        $this->validate($request, [
            'isFavorite' => 'required',
            'parking_id' => 'required|min:1'
        ]);

        $user = Auth::user();
        $rating = Rating::find($id);

        if ($id == 0 || $rating == null)
        {
            return response(
                'No se han encontrado los datos del usuario',
                404
            );   
        }

        //validate if the authenticated user is the rating owner
        if ($user->id !== $rating->user_id)
        {
            return response(
                'No está autorizado para actualizar las califcaciones de otros usuarios', 
                403
            );
        }

        $rating->isFavorite = $request->input('isFavorite');

        $rating->save();

        return ($rating->isFavorite) ? 1 : 0;
    }

    private function findByUserAndParking($user_id, $parking_id)
    {
        $rating = Rating::where('user_id', $user_id)
                    ->where('parking_id', $parking_id)
                    ->first();

        return $rating;
    }
}
