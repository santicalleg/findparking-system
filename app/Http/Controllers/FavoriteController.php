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

        //$user = Auth::user();

//         $users = App\User::with(['posts' => function ($query) {
//     $query->where('title', 'like', '%first%');
// }])->get();

        $parkings = Parking::with(['ratings' => function($querty) {
            $user = Auth::user();
            $querty->where('user_id', $user->id)->where('isFavorite', true);
        }])->paginate(10);

        // $ratings = Rating::with('parking')
        //             ->where('user_id', $user->id)
        //             ->where('isFavorite', true);
        
        if ($parkings->count() > 0) {
            Log::info('Favorite: not empty');
        }
        else {
            Log::info('Favorite: empty');
        }

        //$pakings = $ratings->parking()->paginate(10);

        // $parkings = [];

        // foreach ($rating as $ratings) {
        //     $parking = $rating->parking;
        //     $parkings[] = $parking;
        // }

        return view('favorite/index', compact('parkings'));
    }
}
