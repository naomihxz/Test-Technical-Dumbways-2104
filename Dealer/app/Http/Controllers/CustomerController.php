<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();

        return view('customer.index', ['customers' => $customers]);
    }

    public function store(Request $request){
        $validateData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        Customer::create($validateData);

        return redirect()->route('customer_index');
    }

    public function update(Request $request, Customer $customer){
        $customer = Customer::find($customer->id);

        $customer->name = $request['name'];
        $customer->email = $request['email'];
        $customer->address = $request['address'];
        $customer->save();

        return redirect()->route('customer_index');
    }

    public function destroy(Customer $customer){
        $customer->delete();

        return redirect()->route('customer_index');
    }
}
