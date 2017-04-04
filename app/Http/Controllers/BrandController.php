<?php

namespace findparking\Http\Controllers;

use findparking\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //
    public function index()
    {
    	$brands = Brand::all();

    	return view('brand/index', compact('brands'));
    }

    public function show($id)
    {
    	dd($id);
    }

    public function create()
    {
    	return view('brand/create');
    }

    public function store(Brand $brand)
    {
    	$data = request()->all();
    	Brand::Create($data);

    	dd($brand);
    }
}
