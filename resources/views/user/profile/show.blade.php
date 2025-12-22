<x-layout>
    <x-breadcrumbs 
    class='rounded-b-none rounded-t-none'
    :links="[
        $profile->name => '#' ]"/>
    
    <x-card class='rounded-t-none mb-2 px-3 py-5'>
        <div class='flex gap-5'>
            <div class="container p-2 bg-blue-300 w-fit h-fit rounded-full rounded-tr-none">
                <x-profile-picture class=" max-w-50 max-h-50 min-w-50 min-h-50 border-2 border-blue-950"  :profile="$profile"/>
            </div>
            <div class='flex-col'>
                <div class='flex items-center'>
                    <h2 class='text-2xl font-bold text-slate-900'>
                        {{$profile->name}}
                    </h2>    
                    @can('checkApplications', $user)
                        <span class='text-lg font-bold text-slate-700'>
                            ⋅
                        </span>
                        <h3 class='text-xl font-light text-blue-600'>
                            {{$user->employer->company_name}}
                        </h3>
                    @endcan
                </div>
                <div class="flex items-center justify-between">
                    <div>
                        <h3 class='text-xl font-semilight italic text-slate-600'>
                            {{$profile->title}}
                        </h3>
                    </div>
                     <div class="flex space-x-2 text-slate-300 text-xs font-extrabold">
                        @if($profile->category_1)
                            <x-tag>{{$profile->category_1}}</x-tag>
                        @endif
                        @if($profile->category_2)
                            <x-tag>{{$profile->category_2}}</x-tag>
                        @endif
                        @if($profile->category_3)
                            <x-tag>{{$profile->category_3}}</x-tag>
                        @endif
                    </div>
                </div>
                <div class="flex-col mb-2">
                    <p class="text-sm text-slate-800">
                        {{$profile->about}}
                    </p>
                </div>
                <div class="mt-2 flex space-x-2">
                    <p class="font-light text-xs text-slate-500">
                        <i class="fa-regular fa-clock"></i>
                        Joined {{$user->created_at->diffForHumans()}} 
                    </p>
                    @if($profile->location)
                        <p class="font-light text-xs text-slate-500">
                            <i class="fa-solid fa-location-dot"></i> {{$profile->location}}
                        </p>
                    @endif
                </div>
               
                
            </div>
        </div>
        <hr class="h-px bg-cyan-700 border-0 mt-2">
    </x-card>

    @can('create', \App\Models\Job::class)
        <div class='container rounded-t-lg  text-black  bg-cyan-200 opacity-70 border-2 border-blue-700 pl-5 py-1 max-w-4xl shadow-4xl shadow-black'>
            <h2 class='text-xl font-semibold'>Listed jobs for {{ $user->employer->company_name }}</h2>
        </div>
        <x-card class='mb-2 pt-2 px-3 rounded-t-none'>
            @forelse ($offers as $company_job)
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
    @elsecan('update', $profile)
         <div class='container rounded-t-lg  text-black  bg-cyan-200 opacity-70 border-2 border-blue-700 pl-5 py-1 max-w-4xl shadow-4xl shadow-black'>
            <h2 class='text-xl font-semibold'>Your Job Applications</h2>
        </div>
        <x-card class='mb-2 pt-2 px-3 rounded-t-none'>
            @forelse ($applications as $job_application)
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
                <div class='flex justify-center space-x-1'>
                    <p>Go find some jobs </p>
                    <a href="{{ route('jobs.index') }}" class="text-blue-500 hover:underline">here!</a>
                </div>
            @endforelse
        </x-card>
    @endcan

    
   
</x-layout>