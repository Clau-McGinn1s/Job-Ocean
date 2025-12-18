<x-layout>
    <x-breadcrumbs class='rounded-b-none rounded-t-none'
        :links="[
        $user->name => route('user.show', $user),
        'Deleted Applications' => '#' ]"
    />
   
    <x-card class='mb-2 mt-2 pt-2 px-3'>
        <div class="flex justify-between items-center">
            <p class='text-xl font-bold text-slate-800'>
                Deleted Job Applications
            </p>
            <a class='text-lg text-center text-blue-600 hover:text-cyan-300' href='{{ route("user.show", $user) }}'>
                Go back to Active Applications <i class="fa-solid fa-circle-chevron-right"></i>
            </a>
        </div>
         
        <hr class="h-px bg-cyan-700 border-0 my-2">

        @forelse ($job_applications as $job_application)
            <x-job-card class='mb-2 px-3 shadow-slate-100' :job='$job_application->job'>
                <div class='container rounded-2xl bg-none border-2 border-cyan-700 p-1 px-4 w-fit flex space-x-8 items-center'>
                    <h2 class="text-md text-slate-800">Desired Salary: ${{number_format($job_application->expected_salary)}}</h2>
                    <h2 class="text-md text-slate-800">Deleted: {{$job_application->deleted_at->diffForHumans()}}</h2>
                    <span class='ml-2'>
                        <a class='text-sm text-blue-800 hover:text-cyan-600' href='{{ route("jobs.show", $job_application->job) }}'>
                            See more <i class="fa-solid fa-circle-chevron-right"></i>
                        </a>
                    </span>
                </div>
            </x-job-card>
        @empty
            <p class='text-xl text-slate-700 text-center'>No deleted applications</p>
            @cannot('checkApplications', $user)
                <div class='flex justify-center space-x-1'>
                    <p>Go find some jobs </p>
                    <a href="{{ route('jobs.index') }}" class="text-blue-500 hover:underline">here!</a>
                </div>
            @endcannot
        @endforelse
    </x-card>   
</x-layout>