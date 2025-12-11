 @props(["job"])  
   <x-card {{ $attributes->class([''])}}>
        <div class='flex justify-between'>
            <h2 class='text-2xl font-bold text-slate-300'>{{$job->title}}</h2>
            <h3 class='text-lg font-light text-blue-400'>$ {{number_format($job->salary)}}</h3>
        </div>
        <div class='flex justify-between text-sm font-light text-slate-400 my-2 ml-2 items-center'>
            <div class='flex space-x-2'>
                <h4>Company Name</h4>
                <span>
                    <i class="fa-solid fa-location-dot"></i>
                    {{$job->location}}
                </span>
            </div>
                <div class='flex text-cyan-400 space-x-2 font-extralight text-xs'>
                <x-tag>
                    <a href="{{ route('jobs.index', ['experience'=>$job->experience])}}"
                        class="hover:text-blue-200">
                        {{Str::ucfirst($job->experience)}}
                    </a>
                </x-tag>
                <x-tag>
                    <a href="{{ route('jobs.index', ['category'=>$job->category])}}"
                        class="hover:text-blue-200">
                        {{Str::ucfirst($job->category)}}
                    </a>
                </x-tag>
            </div>
        </div>
        {{ $slot }}
        <hr class="h-px bg-cyan-700 border-0 mt-2">
    </x-card>