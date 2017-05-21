<?php

namespace findparking\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    //
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'parking_id' => 'required'
    	]);

    	try
    	{
    		$user = Auth::user();
			$vehicles = $user->vehicles();
	    	$vehicle = $vehicles->where('is_active', 1)->first();

    		$parking_id = $request->input('parking_id');
    		$parking = Parking::find($parking_id);
    		$slots = $parking->slots();

    		$fillSlot = $slots->where('vehicle_id', $vehicle->last_digit)->first();

    		$slot = Slot::find($freeSlot->id);
    		$slot->vehicle_id = '';
			$slot->save();

			Session::flash('message', 'Has parqueado!');
    	}
    	catch(Exception $e)
        {
            return redirect()->route('checkin.index')
                    ->withErrors("Faltal error - ".$e->getMessage());
        }
    }
}
