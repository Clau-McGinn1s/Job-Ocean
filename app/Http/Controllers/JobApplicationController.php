<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;

use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Attribute\Cache;

class JobApplicationController extends Controller
{
    public function create(Job $job){
        if($job->jobApplications()->where
        ('user_id', request()->user()->id)->exists()){
            session()->flash('warning', 'You already applied to this job');
            return redirect()->route('jobs.show', $job);
        }
        return view('job_application.create', ['job' => $job]);
    }

    public function store(Request $request, Job $job){

        $user_id = $request->user()->id;
        $data = $request->validate([
            'expected_salary' => 'required|integer|min:1|max:1000000'
        ]);

        if($job->jobApplications()->where('user_id', $user_id)->exists()){
            session()->flash('warning', 'You already applied to this job');
            return redirect()->route('jobs.show', $job);
        }

        $job->jobApplications()->create([
            'user_id' => $user_id,
            ...$data
        ]);

        session()->flash('success', "Sent application for " . $job->title);

        return redirect()->route('jobs.show', $job);
    }

    public function index(Job $job){
        JobApplication::where("job_id", $job->id)->get();

        return view('job_application.index', [
            "job" => $job,
            "job_applications" => JobApplication::where("job_id", $job->id)->get()
        ]);
    }

    public function destroy($job, JobApplication $application){
        session()->flash('success',"Application deleted for " . $application->job->title);

        JobApplication::whereId($application->id)->delete();

        return redirect()->route('user.show', request()->user());
    }
}
