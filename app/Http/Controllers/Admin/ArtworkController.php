<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use Illuminate\Http\Request;


class ArtworkController extends Controller
{
    public function index()
    {
        $artworks = Artwork::all();

        return view(
            'admin.artwork.index',
            compact('artworks')
        );
    }

    public function create()
    {
        return view('admin.artwork.add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'artist_name' => 'required',
            'description' => 'required',
            'price' => 'required',

        ]);

        $file=$request->photo;
        $filename="null";
        if ($file){
            $filename=$file->getClientOriginalName().'artwork.'.$file->getClientOriginalExtension();
            $request->photo->move('artword',$filename);
        }

        if($request->hasFile('art_image')){
            $imageName = time() . '.' . $request->art_image->extension();
            $request->art_image->move(public_path('artwork'), $imageName);
        }
        

        Artwork::create([
            'name' => $validatedData['name'],
            'artist_name' => $validatedData['artist_name'],
            'description' => $validatedData['description'],
            'price' => $validatedData['price'],
            'image' => $imageName,
        ]);

        return redirect()->route('admin.artwork.index')->with('success', 'Artwork created successfully.');
    }

    public function edit($id)
    {
        $artwork = Artwork::find($id);
        return view('admin.artwork.edit', [
            'artwork' => $artwork,
        ]);
    }

    public function update(Request $request,)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'artist_name' => 'required|exists:artists,name',
            // 'artist_id' => 'required|exists:artists,id',
            'description' => 'required',
            // 'category_id' => 'required|exists:categories,id',
            'price' => 'required',

        ]);
        $id = $request->id;

        $data = Artwork::find($id);
        $data->name = $request->name;
        $data->artist_name = $request->artist_name;
        // $data->artist_id = $request->artist_id;
        $data->description = $request->description;
        // $data->category_id = $request->category_id;
        $data->price = $request->price;
        // $artwork->update([
        //     'name' => $validatedData['name'],
        //     'artist_name' => $validatedData['artist_name'],
        //     'artist_id' => $validatedData['artist_id'],
        //     'description' => $validatedData['description'],
        //     'category_id' => $validatedData['category_id'],
        //     'price' => $validatedData['price'],

        // ]);
        $data->save();
        return redirect()->route('admin.artwork.index')->with('success', 'Artwork updated successfully.');
    }

    public function destroy($id)
    {
        $artwork = Artwork::findOrFail($id);
        $artwork->delete();

        return redirect()
            ->route('admin.artwork.index')
            ->with('success', 'Artwork deleted successfully.');
    }
    public function status($id)
    {
        $data  = Artwork::find($id);
        if ($data->active == true) {
            $data->active = false;
        } else {
            $data->active = true;
        }
        $data->save();
        return redirect()->route('admin.artwork.index')->with('success', 'Artwork status update successfully.');
    }
}
