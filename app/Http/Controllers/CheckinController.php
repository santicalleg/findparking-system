<?php

namespace findparking\Http\Controllers;

use Session;
use Exception;
use findparking\User;
use findparking\Slot;
use findparking\Parking;
use findparking\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckinController extends Controller
{
    //
    public function index()
    {
    	return view("checkin/index");
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
    		'parking_id' => 'required'
    	]);
    	
    	try
    	{
    		$parking_id = $request->input('parking_id');
    		$parking = Parking::find($parking_id);
    		$slots = $parking->slots();

    		if ($slots->count() > 0)
    		{
    			$user = Auth::user();
	    		
	    		$vehicles = $user->vehicles();
	    		$vehicle = $vehicles->where('is_active', 1)->first();

    			$freeSlot = $slots->whereNull('vehicle_id')->first();
    			$slot = Slot::find($freeSlot->id);
    			$slot->vehicle_id = $vehicles->last_digit;
    			$slot->save();

    			Session::flash('message', 'Has parqueado!');
    		}
    		else
    		{
    			return redirect()->route('checkin.index')
                    ->withErrors("Oops, ya no hay mas lugares para ".
                    	"estacionar en el parqueadero ".$parking->parking_name);
    		}
    	}
    	catch(Exception $e)
        {
            return redirect()->route('checkin.index')
                    ->withErrors("Faltal error - ".$e->getMessage());
        }
    }
}
