<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request){


        $jobs = Job::query();
        
        $jobs
        ->when($request['search'], fn($query) => 
            $query->where(function ($query) use($request){
                $query->where('title', 'like', '%' . $request['search'] . '%')
                ->orWhere('description', 'like', '%' . $request['search'] . '%');
            }))
        ->when($request['min_salary'], fn($query) => 
            $query->where('salary', '>=', (int)$request['min_salary']))
        ->when($request['max_salary'], fn($query) =>
            $query->where('salary', '<=', (int)$request['max_salary'] ))
        ->when($request['experience'], fn($query)=>
            $query->where('experience' , $request['experience']))
        ->when($request['category'], fn($query)=>
            $query->where('category', $request['category']));
    

        return view('jobs.index', ['jobs'=>$jobs->get()]);
    }

    public function show(Job $job){
        return view('jobs.show', compact('job'));
    }
}
