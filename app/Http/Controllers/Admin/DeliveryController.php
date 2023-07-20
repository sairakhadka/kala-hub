<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        $deliveries = Delivery::all();

        return view('admin.delivery.index', [
            'deliveries' => $deliveries,
        ]);
    }

    public function create()
    {
        return view('admin.delivery.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|unique:deliveries',
            'customer_number' => 'required',
            'customer_address' => 'required',


        ]);

        $delivery = Delivery::create([

            'customer_name' => $validatedData['customer_name'],
            'customer_number' => $validatedData['customer_number'],
            'customer_address' => $validatedData['customer_address'],
        ]);

        return redirect()->route('admin.deliveries.index')->with('success', 'Delivery created successfully.');
    }

    public function edit(Delivery $delivery)
    {
        return view('admin.delivery.edit', [
            'delivery' => $delivery,
        ]);
    }

    public function update(Request $request, Delivery $delivery)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|unique:deliveries,name,' . $delivery->id,
            'customer_number' => 'required',
            'address' => 'required',

        ]);

        $delivery->update([
            'customer_name' => $validatedData['customer_name'],
            'customer_number' => $validatedData['customer_number'],
            'customer_address' => $validatedData['customer_address'],
        ]);

        return redirect()->route('delivery.index')->with('success', 'Delivery updated successfully.');
    }

    public function destroy(Delivery $delivery)
    {
        $delivery->delete();

        return redirect()->route('delivery.index')->with('success', 'Delivery deleted successfully.');
    }
    public function status($id)
    {
        $data  = Delivery::find($id);
        if ($data->active == true) {
            $data->active = false;
        } else {
            $data->active = true;
        }
        $data->save();
        return redirect()->route('delivery.index')->with('success', 'Delivery status update successfully.');
    }
}
