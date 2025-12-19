<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class JobApplicationController extends Controller
{
    public function create(Job $job){

        if(!Auth::check()){
            session()->flash('warning', 'You must be logged in to do that');
            return redirect()->route('login');
        }
     
        if(!Auth::user()->can('apply', $job)){
            session()->flash('warning', 'You already applied to this job');
            return redirect()->route('jobs.show', $job);
        }

        return view('jobs.applications.create', ['job' => $job]);
    }

    public function store(Request $request, Job $job)
    {
        
        if(!Auth::user()->can('apply', $job)){
            session()->flash('warning', 'You already applied to this job');
            return redirect()->route('jobs.show', $job);
        }

        $user = Auth::user();
        $data = $request->validate([
            'expected_salary' => 'required|integer|min:1|max:1000000',
            'cv' => 'required|file|mimes:pdf|max:2048'
        ]);

       $path = $request->file('cv')->store('cvs', 'local');

        $job->jobApplications()->create([
            'user_id' => $user->id,
            'expected_salary' => $data['expected_salary'],
            'cv_path' => $path
        ]);
        session()->flash('success', "Sent application for " . $job->title);

        return redirect()->route('jobs.show', $job);
    }

    public function index(Job $job)
    {
        return view('jobs.applications.index', [
            "job" => $job,
            "job_applications" => JobApplication::where("job_id", $job->id)->get()
        ]);
    }

    public function destroy($job, JobApplication $application){
        session()->flash('success',"Application deleted for " . $application->job->title);

        if($application->cv_path !== "cvs/pdf_test.pdf"){
            Storage::delete($application->cv_path);
        }
        JobApplication::whereId($application->id)->delete();

        return redirect()->route('user.show', request()->user());
    }

    public function trashed(User $user)
    {   
        if(!$user->jobApplications()->onlyTrashed()->exists()){
            session()->flash("Warning", "No deleted Job Applications found");
            return redirect()->route("user.show", $user);
        }
        return view('jobs.applications.trashed', [
            "user" => $user,
            "job_applications" => $user->jobApplications()->onlyTrashed()->get()
        ]);
    }
}
