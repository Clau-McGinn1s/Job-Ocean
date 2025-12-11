<x-layout>
    <x-breadcrumbs 
    class='rounded-b-none'
    :links="[
        'Jobs' => route('jobs.index'),
        $job->title => '#' ]"/>
     
    <x-job-card class='rounded-t-none' :job='$job'>
       <p class='text-xs text-slate-400 ml-2 mb-2 mr-56'>
            {!! nl2br(e($job->description)) !!}
        </p>    
    </x-job-card> 
</x-layout>