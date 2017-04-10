<?php

namespace findparking\Http\Controllers;

use findparking\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    //
    public function index()
    {
    	$brands = Brand::paginate(10);

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

    public function store()
    {
        //validate data request
        $this->validate(request(), [
            'brand_name' => ['required', 'max:200']
        ]);

    	$data = request()->all();
    	Brand::Create($data);

    	//$dd(data);
        return redirect()->to('brand');
    }
}
