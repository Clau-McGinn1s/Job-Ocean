<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadCv extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(JobApplication $application)
    {
        $path = $application->cv_path;
        if(!Storage::disk('local')->exists($path)){
            session()->flash('warning', "No file found");
            return back();
        }

        $name = $application->user->name . "(" . $application->job->title . ")cv.pdf";
        return Storage::download($path, $name);
    }
}
