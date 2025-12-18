<x-layout>
    <x-breadcrumbs class='rounded-b-none rounded-t-none' 
        :links="[
        'Jobs' => route('jobs.index'), 
        'Deleted Jobs' => '#']"
    />

    <x-card class='p-3 my-2'>
        <div class="flex justify-between items-center">
            <p class='text-xl font-bold text-slate-800'>
                Deleted Jobs
            </p>
            <a class='text-lg text-center text-blue-600 hover:text-cyan-300' href='{{ route("jobs.index") }}'>
                Go back to Active Jobs <i class="fa-solid fa-circle-chevron-right"></i>
            </a>
        </div>

        <hr class="h-px bg-cyan-700 border-0 my-2">
        
        @forelse ($jobs as $job)
            <x-job-card class='mb-2 px-3 shadow-slate-100' :job='$job'>
                <span class='ml-2'>
                    <p class='text-xs text-slate-700 ml-2 mr-56'>
                        {!! nl2br(e($job->description)) !!}
                    </p> 
                </span>
            </x-job-card>
        @empty
            <div class='container bg-none text-center justify-center items-center text-cyan-800 font-extrabold mt-8 mb-6 ml-10 flex-col space-y-3'>
                <div class='text-4xl text-center'>
                    No jobs found <i class="fa-solid fa-face-frown-open"></i>
                </div>
                <div class='text-sm'>
                    Try a different search
                </div>
            </div>
        @endforelse
        @if($jobs->count() > 1)
            <div class='container rounded-t-lg rounded-b-lg text-black bg-blue-300 pl-5 max-w-4xl mb-8'>
                {{ $jobs->links() }}
            </div>
        @endif
    </x-card>
</x-layout>