<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user) 
    {
        if($user->cannot('create', Profile::class)){
            abort(403, "Already have a profile");
        }
        return view("user.profile.create", $user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(User $user, ProfileRequest $request)
    {
        if($user->cannot('create', Profile::class)){
            abort(403, "Already have a profile");
        }
        
        $profile = Profile::for($user)->create($request->validated());
        return redirect()->route("user.profile.show", [$user, $profile])
            ->with("success", "Profile Created");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user, Profile $profile)
    {
        if($user->cannot('view', $profile)){
            abort(403, "Mot authorized");
        }
        return view("user.profile.show", [
            "user" => $user,
            "profile" => $profile,
            "applications" => $user->jobApplications()? $user->jobApplications : [],
            "offers" => $user->hasEmployer()? $user->employer->jobs : []
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, Profile $profile)
    {
        if($user->cannot('update', Profile::class)){
            abort(403, "Mot authorized");
        }
        return view("user.profile.edit", [
            "user" => $user,
            "profile" => $profile
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProfileRequest $request, User $user, Profile $profile)
    {
         if($user->cannot('update', Profile::class)){
            abort(403, "Mot authorized");
        }

        $profile->update($request->validated());

        return redirect()->route("user.profile.show", [
            "user" => $user,
            "profile" => $profile
        ])->with("success", "Profile Updated");
    }
}
