<?php

namespace findparking\Http\Controllers;

use Session;
use Exception;
use findparking\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function edit()
    {
    	$user = User::find(Auth::user()->id);

		return view("/user/edit", compact("user"));
    }

    public function update(Request $request)
    {
    	//validate data request
		$this->validate($request, [
			'name' => 'required|max:255',
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255'
		]);

		$user = User::find(Auth::user()->id);

		if ($user->email !== $request->input('email'))
		{
			$this->validate($request, [
				'email' => 'required|email|max:255|unique:user'
			]);

			$user->email = $request->input('email');
		}

		if ($request->input('password') !== NULL)
		{
			$this->validate($request, [
				'password' => 'min:6|confirmed'
			]);

			$user->password = bcrypt($request->input('password'));
		}

		try
		{
			$user->name = $request->input('name');
			$user->first_name = $request->input('first_name');
			$user->last_name = $request->input('last_name');
			$user->mobile_number = $request->input('mobile_number');

			$user->save();

			Session::flash('message', 'Se ha modificado satisfactoriamente!');
			return redirect()->route('user.edit');
		}
		catch(Exception $e)
    	{
    		return redirect()->route('user.edit')
                    ->withErrors("Faltal error - ".$e->getMessage());
    	}
    }
}
