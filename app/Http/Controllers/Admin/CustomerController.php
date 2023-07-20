<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::all();

        return view('admin.customer.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customer.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email',
            'password' => 'required|string|min:8|max:255',
            'address' => 'required',
            'phone' => 'required',
            // 'gender' => 'required',
        ]);

        Customer::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'address' => $validatedData['address'],
            'phone_number' => $validatedData['phone'],
            'password' => Hash::make($validatedData['password']),
            // 'password' => "password",
            // 'gender' => $validatedData['gender'],
        ]);

        // $customer = Customer::create([
        //     'user_id' => $user->id,
        //     'address' => $validatedData['address'],
        //     'phone_number' => $validatedData['phone_number'],
        //     'gender' => $validatedData['gender'],
        // ]);

        return redirect()->route('customer.index')->with('success', 'Customer created successfully.');
    }

    public function edit($id)
    {
        $data = Customer::find($id);
        return view('admin.customer.edit', ['data' => $data]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'address' => 'required',
            'phone' => 'required',
            // 'gender' => 'required',
        ]);


        $id = $request->id;
        $data = Customer::find($id);


        $data->name = $request->name;
        $data->email = $request->email;
        $data->address = $request->address;
        $data->phone_number = $request->phone;
        // $data->gender = $request->gender;

        $data->save();
        return redirect()->route('customer.index')->with('success', 'Customer updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
    }
    public function status($id)
    {
        $data  = Customer::find($id);
        if ($data->active == true) {
            $data->active = false;
        } else {
            $data->active = true;
        }
        $data->save();
        return redirect()->route('customer.index')->with('success', 'Customer status update successfully.');
    }
}

