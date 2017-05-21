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

    			//Session::flash('message', 'Has estacionado!');

                return response('Has estacionado!', 200);
    		}
    		else
    		{
                Log::warning("Oops, ya no hay mas lugares para ".
                        "estacionar en el parqueadero ".$parking->parking_name);

                abort(409, "Oops, ya no hay mas lugares para ".
                        "estacionar en el parqueadero ".$parking->parking_name);

    			/*return redirect()->route('checkin.index')
                    ->withErrors("Oops, ya no hay mas lugares para ".
                    	"estacionar en el parqueadero ".$parking->parking_name);*/
    		}
    	}
    	catch(Exception $e)
        {
            Log::error("Faltal error - ".$e->getMessage());
            abort(500, 'Ha ocurrido un error en el servidor, por favor comuníquese con el administrador');
            /*return redirect()->route('checkin.index')
                    ->withErrors("Faltal error - ".$e->getMessage());*/
        }
    }
}
