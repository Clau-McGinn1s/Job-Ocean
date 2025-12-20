<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePicGet extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($path)
    {
        abort_unless(Storage::exists($path), 404);

        return response()->file(
            Storage::disk('local')->path($path)
        );
    }
}
