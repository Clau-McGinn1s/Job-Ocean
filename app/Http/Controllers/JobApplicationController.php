<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\JobApplication;

use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function create(Job $job){
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

        session()->flash('success', 'Applied to job!');

        return redirect()->route('jobs.index');
    }
}
