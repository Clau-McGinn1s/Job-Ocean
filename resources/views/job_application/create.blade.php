<x-layout>
     <x-breadcrumbs 
    class='rounded-b-none rounded-t-none'
    :links="[
        'Jobs' => route('jobs.index'),
        $job->title => route('jobs.show', $job),
        'Application' => '#' ]"/>
    <x-job-card class='rounded-t-none mb-2 px-3' :job='$job'>
       <p class='text-xs text-slate-700 ml-2 mb-2 mr-56'>
            {!! nl2br(e($job->description)) !!}
        </p>  

        <p class='text-sm text-cyan-500 ml-2'>
            Contact: {{$job->employer->user->name}}   <i class="fa-regular fa-envelope"></i>   {{$job->employer->user->email}}
        </p>
    </x-job-card > 

    <div class='container rounded-t-lg  text-black bg-cyan-600 pl-5 py-1 max-w-4xl'>
        <h2 class='text-xl font-semibold'>Application Form</h2>
    </div>
    <x-card class='text-slate-900 text-md p-4 px-12 rounded-t-none'>
        <div class="flex items-center justify-between mb-3">
            <p>Name:</p>
            <p>{{auth()->user()->name}}</p>
        </div>
        <div class="flex items-center justify-between mb-3">
            <p>Email:</p>
            <p>{{auth()->user()->email}}</p>
        </div>
        <div class="flex items-center justify-between mb-3">
            <p>Position:</p>
            <p>{{$job->title}}</p>
        </div>
        <form  action="{{ route('job.application.store', $job) }}" method='post' x-ref='form'>
            @csrf
            <div class='flex items-center justify-between'>
                 <label for='expected_salary' class='block'>
                    Expected Salary:
                </label>
                <x-text-input
                    type='number'
                    name='expected_salary' 
                    placeholder="12500"
                    :useRef="false"/>
            </div>
            <div class="flex items-center justify-center mt-5">
              <x-button class="w-2xl">Apply to job</x-button>
            </div>
        </form>
    </x-card>
</x-layout>