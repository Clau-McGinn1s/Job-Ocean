<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePicUpload extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Profile $profile, Request $request)
    {
        $request->validate([ 
            "image" => "file|mimes:png,jpg,jpeg|max:5000"
        ]);

        if(Storage::exists($profile->path)){
            Storage::delete($profile->picture_path);
        }

        $path = $request->file("image")->store("pp", "local");
        $profile->update([
            "picture_path" => $path
        ]);

        return back()->with("success", "Profile Picture Added!");
    }
}
