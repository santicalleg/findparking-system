<?php

namespace findparking\Http\Controllers;

use Log;
use Session;
use Exception;
use findparking\User;
use findparking\Slot;
use findparking\Park;
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
	    		
	    		$vehicles = Vehicle::where('user_id', $user->id);
				
				if ($vehicles->count() == 0) 
				{
					return response('Por favor adicione un vehículo y establezcalo en uso para poder parquear', 400);
				}

				$vehicle = $vehicles->where('is_active', 1)->first();

				if (empty($vehicle))
				{
					return response('Actualmente no tiene un vehículo en uso', 400);
				}

                $park = new Park;
                $park->user_id = $user->id;
                $park->vehicle_id = $vehicle->id;
                $park->parking_id = $parking->id;
                $park->save();

    			$freeSlot = $slots->whereNull('vehicle_id')->first();
    			$slot = Slot::find($freeSlot->id);
    			$slot->vehicle_id = $vehicle->last_digit;
    			$slot->save();

                return response('Has estacionado!', 200);
    		}
    		else
    		{
                Log::warning("Oops, ya no hay mas lugares para ".
                        "estacionar en el parqueadero ".$parking->parking_name);

                return response("Oops, ya no hay mas lugares para ".
                        "estacionar en el parqueadero ".$parking->parking_name, 409);
    		}
    	}
    	catch(Exception $e)
        {
            Log::error("Faltal error - ".$e->getMessage());
            return response('Ha ocurrido un error en el servidor, por favor comuníquese con el administrador', 500);
        }
    }
}
