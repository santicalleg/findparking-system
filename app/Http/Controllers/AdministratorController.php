<?php

namespace findparking\Http\Controllers;

use Session;
use Exception;
use findparking\Administrator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use findparking\Http\Controllers\Controller;

class AdministratorController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth:admin');
	}

    public function index()
    {
    	return view("/administrator/index");
    }

	public function edit()
	{
		$admin = Administrator::find(Auth::user()->id);

		return view("/administrator/edit", compact("admin"));
	}

	public function update(Request $request)
	{
		//validate data request
		$this->validate($request, [
			'name' => 'required|max:255',
			'administrator_first_name' => 'required|max:255',
			'administrator_last_name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:user',
			'password' => 'required|min:6|confirmed'
		]);

		try
		{
			$admin = Administrator::find(Auth::user()->id);

			$admin->name = $request->input('name');
			$admin->administrator_first_name = $request->input('administrator_first_name');
			$admin->administrator_last_name = $request->input('administrator_last_name');
			$admin->email = $request->input('email');
			$admin->password = bcrypt($request->input('password'));

			$admin->save();

			Session::flash('message', 'Se ha modificado satisfactoriamente!');
			return redirect()->route('admin.edit');
		}
		catch(Exception $e)
    	{
    		return redirect()->route('administrator.index')
                    ->withErrors("Faltal error - ".$e->getMessage());
    	}
	}
}
