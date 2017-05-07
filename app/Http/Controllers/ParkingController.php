<?php

namespace findparking\Http\Controllers;

use Session;
use Exception;
use findparking\Slot;
use findparking\Parking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ParkingController extends Controller
{
    public function index()
    {
    	$parkings = Parking::paginate(10);

    	return view('parking/index', compact('parkings'));
    }

    public function show($id)
    {
    	$parking = Parking::find($id);
    	dd($parking);
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
            'quantity_slots' => 'required|numeric|min:1'
		]);

		try
    	{
    		$data = $request->all();
            $quantity = $request->input('quantity_slots');

    		$parking = new Parking($data);
    		$parking->administrator_id = Auth::user()->id;
    		$parking->save();
            
			$slots = [];
            for ($i=1; $i <=$quantity ; $i++) {
                $slot = new Slot;
                $slot->name = "A" . $i;
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

    	return view('parking/edit', compact('parking'));
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
            'quantity_slots' => 'required|numeric|min:1'
		]);

		try
    	{
            $quantity = $request->input('quantity_slots');
    		$parking = Parking::find($id);

    		$parking->parking_name = $request->input('parking_name');
    		$parking->nit = $request->input('nit');
    		$parking->phone_number = $request->input('phone_number');
    		$parking->latitude = $request->input('latitude');
    		$parking->longitude = $request->input('longitude');
    		$parking->address = $request->input('address');
    		$parking->services = $request->input('services');
    		$parking->schedule = $request->input('schedule');

    		$parking->save();

            if ($parking->slots()->count() != $quantity && $quantity > 0) {
                $parking->slots()->delete();

                for ($i=1; $i <=$quantity ; $i++) {
                    $slot = new Slot;
                    $slot->name = "A" . $i;
                    $slot->parking_id = $parking->id;

                    $slot->save();
                }
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
