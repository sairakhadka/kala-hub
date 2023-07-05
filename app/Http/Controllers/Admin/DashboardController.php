<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Artist;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $adminUsers = User::where('role', 'admin')->get();
        $artists = Artist::all();

        return view('admin.dashboard.index', [
            'adminUsers' => $adminUsers,
            'artists' => $artists,
        ]);
    }

    public function createArtist()
    {
        return view('admin.dashboard.create-artist');
    }

    public function storeArtist(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'artist',
        ]);

        Artist::create([
            'user_id' => $user->id,
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('admin.dashboard.index')->with('success', 'Artist created successfully.');
    }

    public function editArtist(Artist $artist)
    {
        return view('admin.dashboard.edit-artist', [
            'artist' => $artist,
        ]);
    }

    public function updateArtist(Request $request, Artist $artist)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $artist->user->id,
            'password' => 'nullable|min:6',
        ]);

        $artist->user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => isset($validatedData['password']) ? bcrypt($validatedData['password']) : $artist->user->password,
        ]);

        $artist->update([
            'name' => $validatedData['name'],
        ]);

        return redirect()->route('admin.dashboard.index')->with('success', 'Artist updated successfully.');
    }

    public function deleteArtist(Artist $artist)
    {
        $artist->user->delete();

        return redirect()->route('admin.dashboard.index')->with('success', 'Artist deleted successfully.');
    }





    function dashboard()
    {
        return view('dashboard');
    }

    function customer()
    {
        return view('customer');
    }
}
