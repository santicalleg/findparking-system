<?php

namespace findparking\Http\Controllers;

use Session;
use Exception;
use findparking\Slot;
use findparking\Parking;
use Illuminate\Http\Request;
use findparking\Vehicle_Type;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ParkingController extends Controller
{
    public function index()
    {
    	$parkings = Parking::where('administrator_id', Auth::user()->id)->paginate(10);

    	return view('parking/index', compact('parkings'));
    }

    public function show($id)
    {
    	$parking = Parking::find($id);
    	dd($parking);
    }

    public function detail($id)
    {
        $parking = Parking::find($id);

        return view('parking/detail', compact('parking'));
    }

    public function getAll()
    {
        $parkings = DB::table('parking')
                        ->join('slot', 'parking.id', '=', 'slot.parking_id')
                        ->select('parking.*', DB::raw('count(*) as available_slots'))
                        ->whereNull('slot.vehicle_id')
                        ->groupBy('parking.id', 'parking.parking_name','parking.nit', 
                            'parking.phone_number', 'parking.latitude', 'parking.longitude', 
                            'parking.address', 'parking.services','parking.schedule', 
                            'parking.price', 'parking.rating',
                            'parking.administrator_id', 'parking.created_at', 'parking.updated_at')
                        ->get();

        return $parkings->toJson();
    }

    public function create()
    {
    	return view ('parking/create');
    }

    public function store(Request $request)
    {
		$this->validate($request, [
			'parking_name' => 'required|max:200',
			'nit' => 'required', 'numeric|max:100',
			'phone_number' => 'required|numeric|digits_between:7,20',
			'latitude' => 'required|max:200',
			'longitude' => 'required|max:200',
			'address' => 'required|max:200',
            'cars_quantity_slots' => 'required|numeric',
            'motorcycles_quantity_slots' => 'required|numeric',
            'price' => 'numeric'
		]);

		try
    	{
    		$data = $request->all();
            $cars_quantity = $request->input('cars_quantity_slots');
            $motorcycles_quantity = $request->input('motorcycles_quantity_slots');

    		$parking = new Parking($data);
    		$parking->administrator_id = Auth::user()->id;
    		$parking->save();
            
			$slots = [];
            
            $car_vehicle_type = 
                    Vehicle_Type::where('vehicle_type_name', 'LIKE', '%carro%')->first();
            $motorcycle_vehicle_type = 
                    Vehicle_Type::where('vehicle_type_name', 'LIKE', '%moto%')->first();

            for ($i=1; $i <=$cars_quantity ; $i++) {
                $slot = new Slot;
                $slot->slot_name = "A" . $i;
                $slot->vehicle_type_id = $car_vehicle_type->id;
				$slots[] = $slot;
            }

            for ($i=1; $i <=$motorcycles_quantity ; $i++) {
                $slot = new Slot;
                $slot->slot_name = "A" . $i;
                $slot->vehicle_type_id = $motorcycle_vehicle_type->id;
                $slots[] = $slot;
            }

			$parking->slots()->saveMany($slots);
			
    		Session::flash('message', 'Se ha creado satisfactoriamente!');

    		return redirect()->route('parking.index');
    	}
    	catch(Exception $e)
    	{
    		return redirect()->route('parking.create')
                    ->withErrors("Faltal error - ".$e->getMessage());
    	}
    }

    public function edit($id)
    {
    	$parking = Parking::find($id);
        
        $cars_quantity = Slot::where([
            ['vehicle_type_id', '=', 1], 
            ['parking_id', '=', $parking->id]
        ])->count();

        $motorcycles_quantity = Slot::where([
            ['vehicle_type_id', '=', 2], 
            ['parking_id', '=', $parking->id]
        ])->count();

    	return view('parking/edit', compact('parking', 'cars_quantity', 'motorcycles_quantity'));
    }

    public function update(Request $request, $id)
    {
		$this->validate($request, [
			'parking_name' => 'required|max:200',
			'nit' => 'required', 'numeric|max:100',
			'phone_number' => 'required|numeric|digits_between:7,20',
			'latitude' => 'required|max:200',
			'longitude' => 'required|max:200',
			'address' => 'required|max:200',
            'cars_quantity_slots' => 'required|numeric',
            'motorcycles_quantity_slots' => 'required|numeric',
            'price' => 'numeric'
		]);

		try
    	{
            $quantity = 0;
            $cars_quantity = $request->input('cars_quantity_slots');
            $motorcycles_quantity = $request->input('motorcycles_quantity_slots');
            $quantity = $cars_quantity + $motorcycles_quantity;

    		$parking = Parking::find($id);

    		$parking->parking_name = $request->input('parking_name');
    		$parking->nit = $request->input('nit');
    		$parking->phone_number = $request->input('phone_number');
    		$parking->latitude = $request->input('latitude');
    		$parking->longitude = $request->input('longitude');
    		$parking->address = $request->input('address');
    		$parking->services = $request->input('services');
    		$parking->schedule = $request->input('schedule');
            $parking->price = $request->input('price');

    		$parking->save();

            $parking->slots()->delete();

            $car_vehicle_type = 
                    Vehicle_Type::where('vehicle_type_name', 'LIKE', '%carro%')->first();
            $motorcycle_vehicle_type = 
                    Vehicle_Type::where('vehicle_type_name', 'LIKE', '%moto%')->first();

            for ($i=1; $i <=$cars_quantity ; $i++) {
                $slot = new Slot;
                $slot->slot_name = "A" . $i;
                $slot->parking_id = $parking->id;
                $slot->vehicle_type_id = $car_vehicle_type->id;

                $slot->save();
            }

            for ($i=1; $i <=$motorcycles_quantity ; $i++) {
                $slot = new Slot;
                $slot->slot_name = "A" . $i;
                $slot->parking_id = $parking->id;
                $slot->vehicle_type_id = $motorcycle_vehicle_type->id;

                $slot->save();
            }
            
    		Session::flash('message', 'Se ha actualizado satisfactoriamente!');

    		return redirect()->route('parking.index');
    	}
    	catch(Exception $e)
    	{
    		return redirect()->route('parking.edit')
                    ->withErrors("Faltal error - ".$e->getMessage());
    	}
    }

    public function destroy($id)
    {
    	try
    	{
    		$parking = Parking::find($id);

    		$parking->delete();

    		Session::flash('message', 'Se ha eliminado satisfactoriamente!');

    		return redirect()->route('parking.index');
    	}
    	catch(Exception $e)
    	{
    		return redirect()->route('parking.index')
                    ->withErrors("Faltal error - ".$e->getMessage());
    	}
    }
}
