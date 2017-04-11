<?php

namespace findparking\Http\Controllers;

use Session;
use Exception;
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
        $brand = Brand::find($id);
    	dd($brand);
    }

    public function create()
    {
    	return view('brand/create');
    }

    public function store(Request $request)
    {
        try
        {
            //validate data request
            $this->validate($request, [
                'brand_name' => ['required', 'max:200']
            ]);

        	$data = $request->all();
        	Brand::Create($data);

            Session::flash('message', 'Successfully created brand!');
            return redirect()->to('brand');
        }
        catch(Exception $e)
        {
            return redirect()->route('brand.create')
                    ->withErrors("Faltal error - ".$e->getMessage());
        }
    }

    public function edit($id)
    {
        $brand = Brand::find($id);

        return view('brand/edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        try
        {
            //validate data request
            $this->validate($request, [
                'brand_name' => ['required', 'max:200']
            ]);

            $brand = Brand::find($id);

            $brand->brand_name = $request->input('brand_name');
            $brand->save();

            Session::flash('message', 'Successfully updated brand!');
            return redirect()->to('brand');
        }
        catch(Exception $e)
        {
            return redirect()->route('brand.create')
                    ->withErrors("Faltal error - ".$e->getMessage());
        }
    }

    public function destroy($id)
    {
        try
        {
            $brand = Brand::find($id);

            $brand->delete();

            Session::flash('message', 'Successfully deleted brand!');
            return redirect()->route('brand.index');
        }
        catch(Exception $e)
        {
            return redirect()->route('brand.index')
                    ->withErrors("Faltal error - ".$e->getMessage());
        }
    }
}
