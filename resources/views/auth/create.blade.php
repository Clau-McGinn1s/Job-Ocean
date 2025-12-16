<x-layout>
    <x-breadcrumbs class='rounded-b-lg rounded-t-none'
        :links="['Login' => '#']"/>
    <div class='pt-5'>
        <div class='grid grid-cols-2 gap-0  shadow-sm shadow-black rounded-xl'>
            <div class='container rounded-l-xl p-7 bg-blue-900 text-cyan-500 text-center flex-col space-y-5 items-center'>
                <h1 class='text-8xl pt-48'><i class="fa-solid fa-house-flood-water"></i></h1>
                <h1 class='text-5xl font-bold'>Job Ocean</h1>
            </div>
            <div class='rounded-r-xl bg-slate-100 flex-col p-1 px-12  py-42'>
                <h2 class='text-3xl font-bold text-slate-900 text-center mb-12'>Sing Into Your Account</h2>
                <form action="{{ route('auth.store') }}" method="POST">
                    @csrf
                    
                    <div class='my-4 flex-col space-y-1'>
                        <label class='text-slate-900 grow block'>
                            E-mail
                        </label>
                        <x-text-input name="email" placeholder="example@mail.com" :useRef="false" />
                    </div>
                    <div class='my-4 flex-col space-y-1'>
                        <label class='text-slate-900 grow block'>
                            Password
                        </label>
                        <x-text-input name="password" placeholder="**********" type="password" :useRef="false" />
                    </div>
                    <div class="flex justify-between">
                        <div >
                            <div class='flex items-center space-x-1'>
                                <input type='checkbox' name='remember'
                                class='appearance-none w-3 h-3 rounded-sm border border-cyan-700 checked:bg-cyan-300 checked:border-cyan-300'/>
                                <label class='text-slate-700 text-sm' for='remember'>
                                    Remember Me
                                </label>
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