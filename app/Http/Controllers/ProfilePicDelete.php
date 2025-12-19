<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class ProfilePicDelete extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Profile $profile)
    {
        if(Storage::exists($profile->path)){
            Storage::delete($profile->picture_path);
            $profile->update([
                "picture_path" => null
            ]);
            session()->flash("success", "Profile Picture deleted");
        }
        return back();
    }    
}
