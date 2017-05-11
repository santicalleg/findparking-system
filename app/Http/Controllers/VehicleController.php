<?php

namespace findparking\Http\Controllers;

use Session;
use Exception;
use findparking\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    //
    public function index()
    {
    	$vehicles = Vehicle::paginate(10);

    	return view('vehicle/index', compact('vehicles'));
    }

    public function create()
    {
    	return view('vehicle/create');
    }

    public function store(Request $request)
    {
    	//validate data request
        $this->validate($request, [
            'color_id' => 'required|numeric|min:1',
            'brand_id' => 'required|numeric|min:1',
            'vehicle_type_id' => 'required|numeric|min:1'
        ]);

        try
        {
        	$data = $request->all();
        	$vehicle = new Vehicle($data);
        	$vehicle->user_id = Auth::user()->id;

        	Vehicle::Create($vehicle);

        	Session::flash('message', 'Se ha creado satisfactoriamente!');
            return redirect()->route('vehicle.index');
        }
        catch(Exception $e)
    	{
    		return redirect()->route('vehicle.create')
                    ->withErrors("Faltal error - ".$e->getMessage());
    	}
    }

    public function edit($id)
    {
    	$vehicle = Vehicle::find($id);

    	return view('vehicle/edit', compact('vehicle'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
            'color_id' => 'required|numeric|min:1',
            'brand_id' => 'required|numeric|min:1',
            'vehicle_type_id' => 'required|numeric|min:1'
        ]);

        try
        {
			$vehicle = Vehicle::find($id);

			//TODO: Validate if the user is the same between auth and vehicle owner.

			$vehicle->color_id = $request->input('color_id');
			$vehicle->brand_id = $request->input('color_id');
			$vehicle->vehicle_type_id = $request->input('color_id');

			$vehicle->save();

            Session::flash('message', 'Se ha actualizado satisfactoriamente!');
            return redirect()->route('vehicle.index');
        }
        catch(Exception $e)
    	{
    		return redirect()->route('vehicle.edit')
                    ->withErrors("Faltal error - ".$e->getMessage());
    	}
    }

    public function destroy($id)
    {
        try
        {
            $vehicle = Vehicle::find($id);

            $vehicle->delete();

            Session::flash('message', 'Se ha eliminado satisfactoriamente!');
            return redirect()->route('vehicle.index');
        }
        catch(Exception $e)
        {
            return redirect()->route('vehicle.index')
                    ->withErrors("Faltal error - ".$e->getMessage());
        }
    }
}
