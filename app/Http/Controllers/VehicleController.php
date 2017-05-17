<?php

namespace findparking\Http\Controllers;

use Log;
use Session;
use Exception;
use findparking\Brand;
use findparking\Color;
use findparking\Vehicle;
use findparking\Vehicle_Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $colors = Color::all(['color_name', 'id']);
        $brands = Brand::all(['brand_name', 'id']);
        $types = Vehicle_Type::all(['vehicle_type_name', 'id']);
    	return view('vehicle.create', compact('colors', 'brands', 'types'));
    }

    public function store(Request $request)
    {
        Log::info('validating');

    	//validate data request
        $this->validate($request, [
            'last_digit' => 'required|max:6',
            'color_id' => 'required|numeric|min:1',
            'brand_id' => 'required|numeric|min:1',
            'vehicle_type_id' => 'required|numeric|min:1'
        ]);

        try
        {
        	$data = $request->all();

        	$vehicle = new Vehicle($data);
            $vehicle->user_id = Auth::user()->id;

        	$vehicle->save();

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

        $colors = Color::all(['color_name', 'id']);
        $brands = Brand::all(['brand_name', 'id']);
        $types = Vehicle_Type::all(['vehicle_type_name', 'id']);

    	return view('vehicle/edit', compact('vehicle', 'colors', 'brands', 'types'));
    }

    public function update(Request $request, $id)
    {
        Log::info('edit-validating');

    	$this->validate($request, [
            'color_id' => 'required|numeric|min:1',
            'brand_id' => 'required|numeric|min:1',
            'vehicle_type_id' => 'required|numeric|min:1'
        ]);

        Log::info('edit-validating-1');

        try
        {
			$vehicle = Vehicle::find($id);

			//TODO: Validate if the user is the same between auth and vehicle owner.

			$vehicle->color_id = $request->input('color_id');
			$vehicle->brand_id = $request->input('brand_id');
			$vehicle->vehicle_type_id = $request->input('vehicle_type_id');

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
