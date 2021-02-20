<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    public function index(){
        $brands = Brand::all();

        return view('brand.index', ['brands' => $brands]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'name' => 'required',
        ]);

        Brand::create($validateData);

        return redirect()->route('brand_index');
    }

    public function update(Request $request, Brand $brand){
        $brand = Brand::find($brand->id);

        $brand->name = $request['name'];
        $brand->save();

        return redirect()->route('brand_index');
    }

    public function destroy(Brand $brand){
        $brand->delete();

        return redirect()->route('brand_index');
    }
}
