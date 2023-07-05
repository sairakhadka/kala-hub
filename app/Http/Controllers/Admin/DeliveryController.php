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

        return view('admin.dashboard.deliveries.index', [
            'deliveries' => $deliveries,
        ]);
    }

    public function create()
    {
        return view('admin.dashboard.deliveries.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:deliveries',
            'description' => 'required',
        ]);

        $delivery = Delivery::create([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);

        return redirect()->route('admin.deliveries.index')->with('success', 'Delivery created successfully.');
    }

    public function edit(Delivery $delivery)
    {
        return view('admin.dashboard.deliveries.edit', [
            'delivery' => $delivery,
        ]);
    }

    public function update(Request $request, Delivery $delivery)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:deliveries,name,' . $delivery->id,
            'description' => 'required',
        ]);

        $delivery->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'],
        ]);

        return redirect()->route('admin.deliveries.index')->with('success', 'Delivery updated successfully.');
    }

    public function destroy(Delivery $delivery)
    {
        $delivery->delete();

        return redirect()->route('admin.deliveries.index')->with('success', 'Delivery deleted successfully.');
    }
}
