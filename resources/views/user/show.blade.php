<x-layout>
    <x-breadcrumbs 
    class='rounded-b-none rounded-t-none'
    :links="[
        $user->name => '#' ]"/>
    
    <x-card class='rounded-t-none mb-2 px-3 py-5'>
        <div class='flex'>
            <span class='text-9xl  text-blue-400'>
                <i class="fa-solid fa-user"></i>
            </span>
            <div class='flex-col justify-between'>
                <h2 class='text-xl font-bold text-slate-300'>
                    <span class='text-sm font-light text-slate-400'>Name  </span>
                    {{$user->name}}
                </h2>
                <h3 class='text-lg font-light text-blue-400'>
                    <span class='text-sm font-light text-slate-400'>Email  </span>
                    {{$user->email}}
                </h3>
            </div>
        </div>
        <hr class="h-px bg-cyan-700 border-0 mt-2">
    </x-card>

    @if ($job_applications->count() > 0)

        <div class='container rounded-t-lg  text-black bg-cyan-600 pl-5 py-1 max-w-4xl'>
            <h2 class='text-xl font-semibold'>Job Applications</h2>
        </div>
        <x-card class='mb-2 pt-2 px-3 rounded-t-none'>
            @foreach ($job_applications as $job_application)
                <x-job-card class='mb-2 px-3 shadow-cyan-950' :job='$job_application->job'>
                    <div class='container rounded-2xl bg-none border-2 border-cyan-700 p-1 px-4 w-fit flex space-x-8 items-center'>
                        <h2 class="text-md text-slate-200">Desired Salary: ${{number_format($job_application->expected_salary)}}</h2>
                        <h2 class="text-md text-slate-200">Applied: {{$job_application->created_at->diffForHumans()}}</h2>

                         <form class='ml-2' 
                            action="{{ route('job.application.destroy', ['job'=>$job_application->job, 'application'=>$job_application])}}" 
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <button class='text-sm text-amber-600 hover:text-amber-400' type='submit'>
                                 Delete Application <i class="fa-solid fa-circle-xmark"></i>
                            </button>
                        </form>       

                        <span class='ml-2'>
                            <a class='text-sm text-blue-300 hover:text-cyan-200' href='{{ route("jobs.show", $job_application->job) }}'>
                                See more <i class="fa-solid fa-circle-chevron-right"></i>
                            </a>
                        </span>
                    </div>
                </x-job-card>
            @endforeach
        </x-card>

    @endif

    @if ($listed_jobs->count() > 0)

        <div class='container rounded-t-lg  text-black bg-cyan-600 pl-5 py-1 max-w-4xl'>
            <h2 class='text-xl font-semibold'>Listed Company Jobs</h2>
        </div>
        <x-card class='mb-2 pt-2 px-3 rounded-t-none'>
            @foreach ($listed_jobs as $company_job)
                <x-job-card class='mb-2 px-3 shadow-cyan-950' :job='$company_job'>
                    <span class='ml-2'>
                        <a class='text-sm text-blue-300 hover:text-cyan-200' href='{{ route("jobs.show", $company_job) }}'>
                            See more <i class="fa-solid fa-circle-chevron-right"></i>
                        </a>
                    </span>
                </x-job-card>
            @endforeach
        </x-card>
    @endif
   
</x-layout>