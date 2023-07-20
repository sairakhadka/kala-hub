<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    public function index()
    {
        // $artists = Artist::where(['active' => 1])->get();
        $artists = Artist::all();

        return view('admin.artist.index', [
            'artists' => $artists,
        ]);
    }

    public function create()
    {
        return view('admin.artist.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email|unique:artists',
            'phone' => 'required',
        ]);

        $file=$request->photo;
        $filename="null";
        if ($file){
            $filename=$file->getClientOriginalName().'artist.'.$file->getClientOriginalExtension();
            $request->photo->move('Artist',$filename);
        }

        Artist::create([
            'name' => $validatedData['name'],
            'address' => $validatedData['address'],
            'email' => $validatedData['email'],
            'phone_number' => $validatedData['phone'],
        ]);

        return redirect()
            ->route('artist.index')
            ->with('success', 'Artist created successfully.');
    }

    public function edit($id)
    {
        $data = Artist::find($id);

        return view('admin.artist.edit', ['data' => $data]);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'email' => 'required',
            'phone' => 'required',
        ]);

        $id = $request->id;

        $data = Artist::find($id);
        $data->name = $request->name;
        $data->address = $request->address;
        $data->email = $request->email;
        $data->phone_number = $request->phone;

        // $artist->update([
        //     'name' => $validatedData['name'],
        //     'address' => $validatedData['address'],
        //     'email' => $validatedData['email'],
        //     'phone_number' => $validatedData['phone_number'],
        // ]);
        $data->save();

        return redirect()
            ->route('artist.index')
            ->with('success', 'Artist updated successfully.');
    }

    public function destroy($id)
    {
        $artist = Artist::findOrFail($id);
        $artist->delete();

        return redirect()
            ->route('artist.index')
            ->with('success', 'Artist deleted successfully.');
    }

    public function status($id)
    {
        $data = Artist::find($id);
        if ($data->active == true) {
            $data->active = false;
        } else {
            $data->active = true;
        }
        $data->save();
        return redirect()
            ->route('artist.index')
            ->with('success', 'Artist status update successfully.');
    }
}
