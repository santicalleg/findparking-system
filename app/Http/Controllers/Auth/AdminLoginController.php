<?php

namespace findparking\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use findparking\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class AdminLoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

	public function __construct()
	{
		$this->middleware('guest:admin');
	}

    public function showLoginForm()
    {
        return view('auth.admin-login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
}
