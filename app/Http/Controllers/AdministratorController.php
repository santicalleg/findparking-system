<?php

namespace findparking\Http\Controllers;

use Illuminate\Http\Request;
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
}
