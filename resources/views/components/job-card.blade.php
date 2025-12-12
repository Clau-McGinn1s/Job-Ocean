 @props(["job"])  
   <x-card {{ $attributes->class([''])}}>
        <div class='flex justify-between'>
            <h2 class='text-2xl font-bold text-slate-300'>{{$job->title}}</h2>
            <h3 class='text-lg font-light text-blue-400'>$ {{number_format($job->salary)}}</h3>
        </div>
        <p class='font-extralight text-xs text-slate-500 ml-2'>
            <i class="fa-regular fa-clock"></i>
            {{$job->created_at->diffForHumans()}}
        </p>
        <div class='flex justify-between text-sm font-light text-slate-400 ml-2 items-center'>
            <div class='flex space-x-2'>
                <a href="{{ route('jobs.index', ['search'=>$job->employer->company_name])}}"
                     class="hover:text-blue-300">
                    <h4>{{$job->employer->company_name}}</h4>
                </a>
                <a href="{{ route('jobs.index', ['search'=>$job->location])}}"
                     class="hover:text-blue-300">
                    <i class="fa-solid fa-location-dot"></i>
                    {{$job->location}}
                </a>
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