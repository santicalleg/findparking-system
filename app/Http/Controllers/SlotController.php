<?php

namespace findparking\Http\Controllers;

use Session;
use Exception;
use findparking\Slot;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    public function index($id)
    {
    	$slots = Slot::where('parking_id', $id)->paginate(10);

    	return view('slot/index', compact('slots'));
    }

    public function create($id)
    {
    	return view('slot/create', compact('id'));
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
			'slot_name' => 'required|max:200',
            'vehicle_id' => 'max:6',
			'parking_id' => 'required|numeric|min:1'
		]);

		try
    	{
    		$data = $request->all();
            
    		$slot = new Slot($data);
    		$slot->save();
            
    		Session::flash('message', 'Se ha creado satisfactoriamente!');

    		return redirect()->route('slot.index', $slot->parking_id);
    	}
    	catch(Exception $e)
    	{
    		return redirect()->route('slot.create', $request->input('parking_id'))
                    ->withErrors("Faltal error - ".$e->getMessage());
    	}
    }

    public function edit($id)
    {
    	$slot = Slot::find($id);

    	return view('slot/edit', compact('slot'));
    }

    public function update(Request $request, $id)
    {
    	$this->validate($request, [
			'slot_name' => 'required|max:200',
            'vehicle_id' => 'max:6'
		]);

		try
		{
			$slot = Slot::find($id);

			$slot->slot_name = $request->input('slot_name');
            $slot->vehicle_id = $request->input('vehicle_id');
			$slot->save();

    		Session::flash('message', 'Se ha actualizado satisfactoriamente!');

    		return redirect()->route('slot.index', $slot->parking_id);
		}
		catch(Exception $e)
		{
			return redirect()->route('slot.edit', $id)
				->withErrors("Fatal error -".$e->getMessage());
		}
    }

    public function destroy($id)
    {
        $slot = Slot::find($id);

		try
    	{
            $parking_id = $slot->parking_id;
    		$slot->delete();

    		Session::flash('message', 'Se ha eliminado satisfactoriamente!');
    		return redirect()->route('slot.index', $parking_id);
    	}
    	catch(Exception $e)
    	{
    		return redirect()->route('slot.index', $slot->parking_id)
                    ->withErrors("Faltal error - ".$e->getMessage());
    	}
    }
}
