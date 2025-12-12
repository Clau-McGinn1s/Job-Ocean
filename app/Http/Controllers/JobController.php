<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request){

        $filters = $request->only(
            'search', 
            'min_salary', 
            'max_salary', 
            'experience', 
            'category',
        );

        return view('jobs.index', 
        ['jobs'=>Job::with('employer')->filter($filters)->paginate(25)]);
    }

    public function show(Job $job){

        $relatedJobs = Job::with('employer')
        ->filter(['search' => $job->employer->company_name])
        ->whereNot('title', $job->title)
        ->get();


        return view('jobs.show', 
        ['job' => $job->load('employer'),
        'relatedJobs' => $relatedJobs]);
    }
}
