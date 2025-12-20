<x-layout>
    <x-breadcrumbs 
    class='rounded-b-none rounded-t-none'
    :links="[
        'Jobs' => route('jobs.index'),
        $job->title => '#' ]"/>
     
    <x-job-card class='rounded-t-none mb-2 px-3' :job='$job'>
       <p class='text-xs text-slate-700 ml-2 mb-2 mr-56'>
            {!! nl2br(e($job->description)) !!}
        </p>   
        
        @auth
             @can('apply', $job)
                <div class='my-7 ml-3'>
                    <a class='text-lg text-blue-600 hover:text-cyan-400' href='{{ route('jobs.applications.create', $job) }}'>
                        Apply for Job <i class="fa-solid fa-circle-chevron-right"></i>
                    </a>
                </div>
            @else
                <div class='my-7 ml-3 flex space-x-3'>
                    <p class='text-md text-slate-600'>
                        Already applied to job
                    </p>
                    <a class='text-lg text-blue-600 hover:text-cyan-400' href='{{ route('user.show',  request()->user())}}'>
                        Check application <i class="fa-solid fa-circle-chevron-right"></i>
                    </a>
                </div>
            @endcan
        @else
            <div class='my-7 ml-3'>
                <a class='text-lg text-blue-600 hover:text-cyan-400' href='{{ route('jobs.applications.create', $job) }}'>
                    Apply for Job <i class="fa-solid fa-circle-chevron-right"></i>
                </a>
            </div>
        @endauth
       
      
    </x-job-card > 

    <div class='container rounded-t-lg  text-black bg-cyan-200 opacity-70 border-2 border-blue-700 pl-5 py-1 max-w-4xl shadow-4xl shadow-black'>
        <h2 class='text-xl font-semibold'>More jobs from <span class="text-blue-800">{{$job->employer->company_name}}</span></h2>
    </div>
    <x-card class='mb-2 pt-2 px-3 rounded-t-none'>
        <hr class="h-px bg-cyan-700 border-0 my-2">
        @forelse ($relatedJobs as $companyJob)
            <x-job-card class='mb-2 px-3 shadow-slate-100' :job='$companyJob'>
            <span class='ml-2'>
                <a class='text-sm text-blue-600 hover:text-cyan-400' href='{{ route("jobs.show", $companyJob) }}'>
                    See more <i class="fa-solid fa-circle-chevron-right"></i>
                </a>
            </span>
        </x-job-card>
        @empty
            <p class="text-xs text-cyan-800">No related Jobs</p>
        @endforelse
    </x-card>
</x-layout>