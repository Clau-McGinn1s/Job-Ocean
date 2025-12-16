
@if(session()->has('success'))
    <div  class='container text-black bg-green-600 pl-5 max-w-4xl'  >
        Success!  {{ session('success') }}
    </div>
@endif
    @if(session()->has('warning'))
    <div class='container text-white bg-red-900 pl-5 max-w-4xl' >
        Warning  {{ session('warning') }}
    </div>
@endif

