<?php

namespace findparking\Http\Controllers;

use Illuminate\Http\Request;
use findparking\Slot;

class SlotController extends Controller
{
    public function index($id)
    {
    	$slots = Slot::where('parking_id', $id)->paginate(10);

    	return view('slot/index', compact('slots'));
    }

    public function create()
    {
    	return view('slot/create');
    }

    public function store(Request $request)
    {
    	$this->validate($request, [
			'name' => 'required|max:200',
			'parking_id' => 'required|numeric|min:1'
		]);

		try
    	{
    		$data = $request->all();
            
    		$slot = new Slot($data);
    		$slot->save();
            
    		Session::flash('message', 'Se ha creado satisfactoriamente!');

    		return redirect()->route('slot.index');
    	}
    	catch(Exception $e)
    	{
    		return redirect()->route('slot.create')
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
			'name' => 'required|max:200',
			'parking_id' => 'required|numeric|min:1'
		]);

		try
		{
			$slot = Slot::find($id);

			$slot->name = $request->input('name');

			$slot->save();

    		Session::flash('message', 'Se ha actualizado satisfactoriamente!');

    		return redirect()->route('slot.index');
		}
		catch(Exception $e)
		{
			return redirect()->route('slot.edit')
				->withErrors("Fatal error -".$e->getMessage());
		}
    }

    public function destroy($id)
    {
		try
    	{
    		$slot = Slot::find($id);

    		$slot->delete();

    		Session::flash('message', 'Se ha eliminado satisfactoriamente!');

    		return redirect()->route('slot.index');
    	}
    	catch(Exception $e)
    	{
    		return redirect()->route('slot.index')
                    ->withErrors("Faltal error - ".$e->getMessage());
    	}
    }
}
