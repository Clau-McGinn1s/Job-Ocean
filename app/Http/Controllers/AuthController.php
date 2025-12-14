<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->filled('remember');


        if(Auth::attempt($credentials, $remember)){
            $username = User::where('email', $credentials['email'])->value('name');

            session()->flash('success', "Welcome back $username");
            return redirect()->route('jobs.index');

        }else{
            session()->flash('warning', 'Invalid Credentials');
            return redirect()->route('auth.create');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        session()->flash('success', 'User logged out');
        return redirect()->route('jobs.index')->with('success', 'User logged out');
    }
}
