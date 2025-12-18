<x-layout>
    <x-breadcrumbs class='rounded-b-none rounded-t-none' :links="['Jobs' => route('jobs.index')]"/>

    @can('checkApplications', request()->user())
        <x-link-button href="{{ route('jobs.create')}}" 
            class="flex justify-between items-center text-xl text-slate-100 font-bold my-3">
            <p> Post New Job </p>
            <p> <i class="fa-solid fa-circle-plus"></i> </p>
        </x-link-button>
    @else
        <x-card class='text-sm text-slate-900 rounded-t-none py-2 mb-2' x-data="">
        
            <form action="{{ route('jobs.index') }}" method='GET' x-ref="form">
                    <div class='mx-2 grid grid-cols-2 gap-3'>
                        <span class="my-1 font-bold">Search
                            <x-text-input name='search' value="{{ request('search') }}" placeholder='Search for any text'/>
                        </span>
                        <span class="my-1 font-bold">Salary
                            <span class="flex space-x-3">
                                <x-text-input name='min_salary' value="{{ request('min_salary') }}" placeholder='From'/>
                                <x-text-input name='max_salary' value="{{ request('max_salary') }}" placeholder='To'/>
                            </span>
                        </span>
                        <x-radio-group
                            name="experience"
                            :options="\App\Models\Job::$experienceLevel"
                            default="all"
                        />
                        <x-radio-group class='flex-wrap'
                            name="category"
                            :options="\App\Models\Job::$jobCategory"
                            default="all"
                        />
                    </div>
                    <button class="rounded-b-lg border border-cyan-400 bg-cyan-700 text-slate-200 font-bold text-center hover:bg-blue-500 w-full mt-2">
                        Filter
                    </button>
                </form>
        </x-card>
    @endcan
    
    @forelse ($jobs as $job)
        <x-job-card class='mb-2 px-3' :job='$job'>
            @can('viewApplications', $job)
                <div class="flex justify-between items-center mt-2">
                    <span class='ml-2'>
                        <a class='text-sm text-blue-600 hover:text-cyan-400' href='{{ route("jobs.applications.index", $job) }}'>
                            See Applications <i class="fa-solid fa-circle-chevron-right"></i>
                        </a>
                    </span>
                    <div class="flex space-x-2">
                        <span>
                            <form action="{{route('jobs.destroy', $job)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete Job {{$job->title}} ?')"
                                    class="flex items-center rounded-lg border border-red-600 bg-amber-800 text-slate-200 text-sm py-2 px-3  hover:bg-amber-500">
                                   <i class="fa-solid fa-square-minus"></i> Delete 
                                </button>
                            </form>
                        </span>
                        <span>
                            <x-link-button class="p-0 text-sm text-slate-200" :href="route('jobs.edit', $job)">
                                <i class="fa-solid fa-square-pen"></i> Edit
                            </x-link-button>
                        </span>
                    </div>
                    
                </div>
            @else
                <span class='ml-2'>
                    <a class='text-sm text-blue-600 hover:text-cyan-400' href='{{ route("jobs.show", $job) }}'>
                        See more <i class="fa-solid fa-circle-chevron-right"></i>
                    </a>
                </span>
            @endcan
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
    @can('checkApplications', request()->user())
     @if (request()->user()->employer->jobs()->onlyTrashed()->exists())
        <span class='mt-8 flex justify-end'>
            <a class='text-xs text-blue-800 hover:underline' href='{{ route("jobs.trashed", request()->user()) }}'>
                See Deleted Jobs <i class="fa-solid fa-trash-can"></i>
            </a>
        </span>
    @endif
    @endcan
    @if($jobs->count() > 1)
        <div class='container rounded-t-lg rounded-b-lg text-black bg-blue-300 pl-5 max-w-4xl mb-8'>
            {{ $jobs->links() }}
        </div>
    @endif
</x-layout>