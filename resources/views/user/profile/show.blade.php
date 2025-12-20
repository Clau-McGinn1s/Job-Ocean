<x-layout>
    <x-breadcrumbs 
    class='rounded-b-none rounded-t-none'
    :links="[
        $profile->name => '#' ]"/>
    
    <x-card class='rounded-t-none mb-2 px-3 py-5'>
        <div class='flex space-x-2'>
            <span class='text-9xl  text-blue-600'>
                <x-profile-picture class="w-25 h-25 border-2 border-blue-950"  :profile="$profile"/>
            </span>
            <div class='flex-col justify-between'>
                <h2 class='text-xl font-bold text-slate-900'>
                    <span class='text-sm font-light text-slate-700'>Name  </span>
                    {{$profile->name}}
                </h2>
                <h3 class='text-lg font-light text-blue-600'>
                    <span class='text-sm font-light text-slate-700'>Email  </span>
                    {{$profile->email}}
                </h3>
                @can('checkApplications', $user)
                    <h3 class='text-lg font-light text-blue-600'>
                        <span class='text-sm font-light text-slate-700'>Company  </span>
                        {{$user->employer->company_name}}
                    </h3>
                    <a class='text-lg text-blue-600 hover:text-cyan-400' href='{{ route("jobs.trashed", $user) }}'>
                        See Deleted Jobs <i class="fa-solid fa-trash-can"></i>
                    </a>
                    <p class="text-xs text-slate-800">
                        {{$profile->about}}
                    </p>
            </div>
        </div>
        <hr class="h-px bg-cyan-700 border-0 mt-2">
    </x-card>

    @can('checkApplications', $user)
        <div class='container rounded-t-lg  text-black bg-none border-2 border-blue-700 pl-5 py-1 max-w-4xl shadow-4xl shadow-black'>
            <h2 class='text-xl font-semibold'>Listed jobs for {{ $user->employer->company_name }}</h2>
        </div>
        <x-card class='mb-2 pt-2 px-3 rounded-t-none'>
            @forelse ($listed_jobs as $company_job)
                <x-job-card class='mb-2 px-3 shadow-slate-100' :job='$company_job'>
                    <span class='ml-2'>
                        <a class='text-sm text-blue-600 hover:text-cyan-400' href='{{ route("jobs.applications.index", $company_job) }}'>
                            See Applications <i class="fa-solid fa-circle-chevron-right"></i>
                        </a>
                    </span>
                </x-job-card>
            @empty
                <p class='text-xl text-slate-700'>No applications to see</p>
            @endforelse
        </x-card>
    @endcan

    
    <div class='container rounded-t-lg  text-blackbg-none border-2 border-blue-700 pl-5 py-1 max-w-4xl shadow-4xl shadow-black'>
        <h2 class='text-xl font-semibold'>Your Job Applications</h2>
    </div>
    <x-card class='mb-2 pt-2 px-3 rounded-t-none'>
        @forelse ($job_applications as $job_application)
            <x-job-card class='mb-2 px-3 shadow-slate-100' :job='$job_application->job'>
                <div class='container rounded-2xl bg-none border-2 border-cyan-700 p-1 px-4 w-fit flex space-x-8 items-center'>
                    <h2 class="text-md text-slate-800">Desired Salary: ${{number_format($job_application->expected_salary)}}</h2>
                    <h2 class="text-md text-slate-800">Applied: {{$job_application->created_at->diffForHumans()}}</h2>

                        <form class='ml-2' 
                        action="{{ route('jobs.applications.destroy', ['job'=>$job_application->job, 'application'=>$job_application])}}" 
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button class='text-sm text-amber-800 hover:text-amber-600' type='submit'>
                            Delete Application <i class="fa-solid fa-circle-xmark"></i>
                        </button>
                    </form>       

                    <span class='ml-2'>
                        <a class='text-sm text-blue-800 hover:text-cyan-600' href='{{ route("jobs.show", $job_application->job) }}'>
                            See more <i class="fa-solid fa-circle-chevron-right"></i>
                        </a>
                    </span>
                </div>
            </x-job-card>
        @empty
            <p class='text-xl text-slate-700 text-center'>No applications to see</p>
            @cannot('checkApplications', $user)
                <div class='flex justify-center space-x-1'>
                    <p>Go find some jobs </p>
                    <a href="{{ route('jobs.index') }}" class="text-blue-500 hover:underline">here!</a>
                </div>
            @endcannot
        @endforelse
    </x-card>


      

   
</x-layout>