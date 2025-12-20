<x-layout>
    <x-breadcrumbs class='rounded-b-lg rounded-t-none'
        :links="['Create Account' => '#']"/>
    <div class='pt-5'>
        <div class='grid grid-cols-2 gap-0 bg-blue-700 shadow-sm shadow-black rounded-xl opacity-90'>
            <div class='container rounded-l-xl p-7 bg-img-wave opacity-90 text-white text-center flex flex-col justify-center items-center space-y-5 min-h-full'>
                <h1 class='text-8xl'><i class="fa-solid fa-house-flood-water"></i></h1>
                <h1 class='text-5xl font-bold'>Job Ocean</h1>
            </div>
            <div class='rounded-r-xl bg-slate-100 flex flex-col p-1 justify-center items-center  py-18'>
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
                    <div class="flex flex-col space-y-3">
                        <a class='text-blue-600 hover:text-cyan-300 hover:underline text-sm' 
                            href='{{ route('employer.create') }}'>
                            Are you looking to post a job listing?
                        </a>
                    </div>
                    <x-button class='w-full font-bold mt-8'>Create Account</x-button>
                    <a class='text-blue-600 hover:text-cyan-300 hover:underline text-sm' 
                        href='{{ route('auth.create') }}'>
                        Already have an account?
                    </a>
                </form>
            </div>
        </div>
    </div>   
    
</x-layout>