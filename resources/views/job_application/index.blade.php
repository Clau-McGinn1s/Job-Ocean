<x-layout>
    <x-breadcrumbs class='rounded-b-none rounded-t-none' :links="[
        'Jobs' => route('jobs.index'),
        $job->title => route('jobs.show', $job),
        'Applications' => '#']"/>

    <x-job-card class='rounded-t-none mb-2 px-3' :job='$job'/>
  
    <div class='container rounded-t-lg  text-black bg-cyan-600 pl-5 py-1 max-w-4xl'>
        <h2 class='text-xl font-semibold'>Job Applications</h2>
    </div>
    <x-card class='px-3 rounded-t-none'>
        @if($job_applications->count() > 0)
        <div class=' px-2 flex justify-between'>
            <p class='font-extralight text-sm text-slate-500 ml-2'>Full Name</p>
            <p class='font-extralight text-sm text-slate-500 ml-2 pl-8'>Email Address</p>
            <p class='font-extralight text-sm text-slate-500 ml-2 pl-8'>Expected Salary</p>
            <p class='font-extralight text-sm text-slate-500 ml-2'>Linked Document</p>
        </div>
        @endif
        @forelse ($job_applications as $job_application)
        
            <div class='mb-3'>
                <div class='flex justify-between items-center'>
                    <h3 class='text-lg font-light text-slate-300'>{{$job_application->user->name}}</h3>
                    <h3 class='text-sm font-light text-slate-300'>{{$job_application->user->email}}</h3>
                    <h3 class='text-lg font-light text-slate-300'> ${{number_format($job_application->expected_salary)}}</h3>
                    <x-link-button href="#" class="p-1 text-sm">Show CV</x-link-button>
                </div>
                <div class='flex justify-between items-center my-2'>
                    <p class='font-extralight text-xs text-slate-400 ml-2'>
                        <i class="fa-regular fa-clock"></i>
                        Applied {{$job_application->created_at->diffForHumans()}}
                    </p>
                     <span class='ml-2'>
                        <a class='text-sm text-blue-300 hover:text-cyan-200' href='mailto:{{$job_application->user->email}}'>
                            Contact <i class="fa-solid fa-circle-chevron-right"></i>
                        </a>
                    </span>
                </div>
                <hr class="h-px bg-cyan-700 border-0 mt-2">
            </div>
        @empty
            <div class='container bg-none text-center text-cyan-700 font-extrabold mt-16 flex-col space-y-3'>
                <div class='text-2xl'>
                    No applicants 
                </div>
            </div>
        @endforelse
    </x-card>
</x-layout>