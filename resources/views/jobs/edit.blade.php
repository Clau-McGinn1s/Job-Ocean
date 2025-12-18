<x-layout>
    <x-breadcrumbs
        :links="[
            'Jobs' => '#',
            'Editing Job' => '#'
        ]"/>

     <div class='container rounded-t-lg  text-blackbg-none border-2 border-blue-700 pl-5 py-1 max-w-4xl shadow-4xl shadow-black mt-2'>
        <h2 class='text-xl font-semibold'>Editing Job <span class='text-lg font-light'>{{$job->title}}</span></h2>
    </div>
    <x-card class='text-sm text-slate-900 rounded-t-none py-2 mb-2' x-data="">
        <form action="{{ route('jobs.update', $job)}}" method='POST' x-ref="form">
            @csrf
            @method('PUT')
            <div class='mx-2 flex-col space-y-5'>
                <div class="flex justify-evenly space-x-4">
                    <div>
                        <x-label label="Job Title" for="title" :required="true"/>
                        <x-text-input name="title" :value="$job->title" placeholder="Executive Officer"/>
                    </div>
                    <div>
                        <x-label label="Offered Salary" for="salary"  :required="true"/>
                        <x-text-input name="salary" type="number" :value="$job->salary" placeholder="15000"/>
                    </div>
                </div>
                <div>
                        <x-label label="Location" for="location" ::required="true"/>
                        <x-text-input name="location" :value="$job->location"  placeholder="Red Ocean"/>
                </div>
                <div>
                        <x-label label="Job Description" for="description" :required="true"/>
                        <x-text-input name="description" type="textarea" :value="$job->description" placeholder="Lorem Ipsum"/>
                </div>
                <div class="flex space-x-4">
                    <div>
                        <x-label label="Experience Level" for="experience" :required="true"/>
                        <x-select name="experience" :value="$job->experience" :options="\App\Models\Job::$experienceLevel"/>
                    </div>
                <div>
                        <x-label label="Job Category" for="category" :required="true"/>
                        <x-select name="category" :value="$job->category" :options="\App\Models\Job::$jobCategory"/>
                    </div>
                </div>
                
            
            <button class="rounded-lg border border-cyan-400 bg-cyan-700 text-slate-200 font-bold text-center hover:bg-blue-500 w-full mt-2">
                Update Job
            </button>
        </form>
    </x-card>

</x-layout>