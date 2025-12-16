<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class EmployerController extends Controller
{
    public function create(){
        return view('employer.create');
    }

    public function store(Request $request){
        $request->validate([
            "name" => "required|string|min:5|max:120",
            "email" => "required|email",
            "password" => "required|min:5|max:20",
            "company_name" => "required"
        ]);

        $user = \App\Models\User::create([
            "name" => $request['name'],
            "email" => $request['email'],
            "password" => Hash::make($request['password']),
            "remember_token" => Str::random(10)
        ]);
        
        Auth::login($user);
         
        $user->employer()->create([
            "company_name" => $request['company_name']
        ]);

        session()->flash("success", "Company Account created!");

        return redirect()->route('jobs.index');
    }
}
