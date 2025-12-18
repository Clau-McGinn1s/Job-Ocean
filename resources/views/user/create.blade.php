<x-layout>
    <x-breadcrumbs class='rounded-b-lg rounded-t-none'
        :links="['Create Account' => '#']"/>
    <div class='pt-5'>
        <div class='grid grid-cols-2 gap-0  shadow-sm shadow-black rounded-xl'>
            <div class='container rounded-l-xl p-7 bg-blue-900 text-cyan-500 text-center flex-col space-y-5 items-center'>
                <h1 class='text-8xl pt-48'><i class="fa-solid fa-house-flood-water"></i></h1>
                <h1 class='text-5xl font-bold'>Job Ocean</h1>
            </div>
            <div class='rounded-r-xl bg-slate-100 flex-col p-1 px-12  py-42'>
                <h2 class='text-3xl font-bold text-slate-900 text-center mb-12'>Create an account</h2>
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf

                     <div class='my-4 flex-col space-y-1'>
                        <x-label for="name" label="Full Name"  :required="true"/>
                        <x-text-input name="name" placeholder="Jean Smith" :useRef="false" />
                    </div>
                    <div class='my-4 flex-col space-y-1'>
                        <x-label for="email" label="Email"  :required="true"/>
                        <x-text-input name="email" placeholder="example@mail.com" :useRef="false" />
                    </div>
                    <div class='my-4 flex-col space-y-1'>
                        <x-label for="password" label="Create a Password"  :required="true"/>
                        <x-text-input name="password" placeholder="**********" type="password" :useRef="false" />
                    </div>
                    <div class="flex justify-between">
                       <a class='text-blue-600 hover:text-cyan-300 hover:underline text-sm' 
                            href='{{ route('auth.create') }}'>
                            Already have an account?
                        </a>
                        <a class='text-blue-600 hover:text-cyan-300 hover:underline text-sm' 
                            href='{{ route('employer.create') }}'>
                            Are you looking to post a job listing?
                        </a>
                    </div>
                    <x-button class='w-full font-bold mt-8'>Create Account</x-button>
                </form>
            </div>
        </div>
    </div>   
    
</x-layout>