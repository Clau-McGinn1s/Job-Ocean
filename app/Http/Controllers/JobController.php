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
            'category'
        );

        return view('jobs.index', ['jobs'=>Job::query()->filter($filters)->get()]);
    }

    public function show(Job $job){
        return view('jobs.show', compact('job'));
    }
}
