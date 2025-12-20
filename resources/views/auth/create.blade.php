<x-layout>
    <x-breadcrumbs class='rounded-b-lg rounded-t-none'
        :links="['Login' => '#']"/>
    <div class='pt-5'>
        <div class='grid grid-cols-2 gap-0 bg-blue-700 shadow-sm shadow-black rounded-xl opacity-90'>
            <div class='container rounded-l-xl p-7 bg-img-wave opacity-90 text-white text-center flex flex-col justify-center items-center space-y-5 min-h-full'>
                <h1 class='text-8xl'><i class="fa-solid fa-house-flood-water"></i></h1>
                <h1 class='text-5xl font-bold'>Job Ocean</h1>
            </div>
            <div class='rounded-r-xl bg-slate-100 flex flex-col p-1 justify-center items-center py-18'>
                <h2 class='text-3xl font-bold text-slate-900 text-center mb-12'>Sing Into Your Account</h2>
                <form action="{{ route('auth.store') }}" method="POST">
                    @csrf
                    
                    <div class='my-4 flex-col space-y-1'>
                        <x-label for="email" label="Email"  :required="true"/>
                        <x-text-input name="email" placeholder="example@mail.com" :useRef="false" />
                    </div>
                    <div class='my-4 flex-col space-y-1'>
                        <x-label for="password" label="Password"  :required="true"/>
                        <x-text-input name="password" placeholder="**********" type="password" :useRef="false" />
                    </div>
                    <div class="flex justify-between space-x-10">
                        <div class='flex items-center'>
                            <div class='flex items-center space-x-1'>
                                <input type='checkbox' name='remember'
                                class='appearance-none w-3 h-3 rounded-sm border border-cyan-700 checked:bg-cyan-300 checked:border-cyan-300'/>
                                <x-label for="remember" label="Remember Me"/>
                            </div>
                        </div>
                        <a class='text-blue-600 hover:text-cyan-300 hover:underline text-sm' 
                            href='#'>
                            Forgot Password?
                        </a>
                    </div>
                    <x-button class='w-full font-bold mt-8'>Log In</x-button>

                    <a class='text-blue-600 hover:text-cyan-300 hover:underline text-sm' 
                        href='{{ route('user.create') }}'>
                        Dont have an account?
                    </a>
                </form>
            </div>
        </div>
    </div>   
    
</x-layout>