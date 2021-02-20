<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function index() {
        $cars = Car::orderBy('id', 'ASC')->get();
        $brands = Brand::all();

        return view('car.index', ['cars' => $cars, 'brands' => $brands]);
    }

    public function store(Request $request){
        if($request->hasFile('image')){
            $validateData = $request->validate([
                'name' => 'required',
                'brand_id' => 'required',
                'image' => 'required',
                'color' => 'required',
                'description' => 'required',
                'stock' => 'required',
            ]);

            $ext_image = $request->image->extension();
            $judul_image = $request["brand_id"]."_".$request["name"]."_".$request["color"].".".$ext_image;

            $path_template = Storage::putFileAs('public/cars_image', $request->file('image'), $judul_image);

            $new_car = new Car();
            $new_car->name = $validateData["name"];
            $new_car->brand_id = $validateData["brand_id"];
            $new_car->image = $path_template;
            $new_car->color= $validateData["color"];
            $new_car->stock = $validateData["stock"];
            $new_car->save();

            return redirect()->route('car_index');
        } else {
            return "Error no image";
        }
    }

    public function showImg($id){
        $result = Car::find($id);

        return Storage::download($result->image);
    }

    public function tambahStok(Request $request, Car $car){
        $car = Car::find($car->id);

        $car->stock += $request['stock'];
        $car->save();

        return redirect()->route('car_index');
    }

    public function destroy(Car $car){
        $car->delete();

        return redirect()->route('car_index');
    }
}
