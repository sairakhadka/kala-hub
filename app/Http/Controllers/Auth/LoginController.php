<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showLoginForm()
{
    return view('auth.login');
}

public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (auth()->attempt($credentials)) {
        // Authentication successful, redirect to a desired location
        return redirect()->intended('/dashboard');
    }

    // Authentication failed, redirect back with error message
    return redirect()->back()->withInput()->withErrors([
        'email' => 'Invalid credentials',
    ]);
}

public function logout()
{
    auth()->logout();
    return redirect('/');
}

}
