<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          $request->validate([
            "name" => "required|string|min:5|max:120",
            "email" => "required|email",
            "password" => "required|min:5|max:20",
        ]);

        $user = \App\Models\User::create([
            "name" => $request['name'],
            "email" => $request['email'],
            "password" => Hash::make($request['password']),
            "remember_token" => Str::random(10)
        ]);

        Auth::login($user);

        session()->flash("success", "New Account created!");

        return redirect()->route('jobs.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $job_applications = JobApplication::where("user_id", $user->id)->get();

        $listed_jobs = when( $user->employer->exists(), 
        Job::where('employer_id', $user->employer->id)->get(), ['']);

        return view('user.show', [
            "user" => $user,
            "job_applications" => $job_applications,
            "listed_jobs" => $listed_jobs
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
