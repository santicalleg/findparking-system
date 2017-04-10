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
        $brand = Brand::where('brand_id', $id)->first();
    	dd($brand);
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

    public function edit($id)
    {
        //TODO: Fix issue with find eloquent property, it cannot find brand_id property name, it searches like brand.id
        $brand = Brand::where('brand_id', $id)->first();

        return view('brand/edit', compact('brand'));
    }

    public function update($id)
    {
        //validate data request
        $this->validate(request(), [
            'brand_name' => ['required', 'max:200']
        ]);

        $brand = Brand::where('brand_id', $id)->first();

        //TODO: Fix issue to update a record
        $brand->brand_name = request()->input('brand_name');
        $brand->save();

        return redirect()->to('brand');
    }
}
