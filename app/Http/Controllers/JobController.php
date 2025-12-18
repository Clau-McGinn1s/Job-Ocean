<?php

namespace App\Http\Controllers;

use App\Http\Requests\JobRequest;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    public function index(Request $request)
    {   
        if(Auth::user()?->can('create', Job::class)){
            return view('jobs.index', [
                'jobs'=>Auth::user()->employer->jobs()
                ->latest('updated_at')
                ->paginate(25)
            ]);
        }

        $filters = $request->only(
            'search', 
            'min_salary', 
            'max_salary', 
            'experience', 
            'category',
        );

        return view('jobs.index', [
            'jobs'=>Job::with('employer')
            ->filter($filters)
            ->latest('updated_at')
            ->paginate(25)
        ]);
    }

    public function show(Job $job)
    {
        $relatedJobs = Job::with('employer')
        ->filter(['search' => $job->employer->company_name])
        ->whereNot('title', $job->title)
        ->get();


        return view('jobs.show', 
        ['job' => $job->load('employer'),
        'relatedJobs' => $relatedJobs]);
    }

    public function create()
    {
        if(Auth::user()->can('create', Job::class)){
            return view('jobs.create');
        }else{
            abort(403, "Not an Employer");
        }
    }

    public function store(JobRequest $request)
    {
        if(Auth::user()->cannot('create', Job::class)){
            abort(403, "Not an Employer");
        }

        Auth::user()->employer->jobs()->create($request->validated());

        session()->flash("success", "Job '" . $request->validated("title") . "' created.");
        return redirect()->route("jobs.index");
    }

    public function edit(Job $job)
    {
        if(Auth::user()->cannot('update', $job)){
            session()->flash("warning", "Cannot update a Job with applications");
            return redirect()->route("jobs.index");
        }

        return view('jobs.edit', ["job" => $job]);
    }

    public function update(JobRequest $request, Job $job)
    {
        if(Auth::user()->cannot('create', Job::class)){
            abort(403, "Not an Employer");
        }
        if(Auth::user()->cannot('update', $job)){
            session()->flash("warning", "Cannot update a Job with applications");
            return redirect('jobs.index');
        }

        $job->update($request->validated());
        session()->flash("success", "Job '" . $request->validated("title") . "' updated!");
        return redirect()->route('jobs.index');
    }

    public function destroy(Job $job)
    {
        if(Auth::user()->cannot('delete', $job)){
            abort (403, 'Employer and Job do not match');
        }

        $job->delete();
        session()->flash('success', "Job '" . $job->title . "' deleted successfully");
        return redirect()->route('jobs.index');
    }

    public function trashed(User $user)
    {   
        if(!$user->employer->jobs()->onlyTrashed()->exists()){
            session()->flash("warning", "No deleted jobs found");
            return redirect()->route("user.show", $user);
        }
        return view('jobs.trashed',   [
            'jobs'=>$user
            ->employer->jobs()
            ->onlyTrashed()
            ->latest('deleted_at')
            ->paginate(25) 
        ]);
    }
}
