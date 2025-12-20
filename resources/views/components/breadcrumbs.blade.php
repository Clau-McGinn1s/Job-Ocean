<nav {{$attributes->class(['container rounded-t-lg rounded-b-lg text-black pl-5 max-w-4xl border-2 border-blue-800 bg-cyan-200 opacity-50'])}}>
    <ul class='flex space-x-1 opacity-100'>
        <li> 
            <a class='hover:text-blue-600' href="/">Home</a>
        </li>
        @isset($links)
            @foreach ($links as $label => $link )
            <li>
                <i class="fa-solid fa-chevron-right"></i>
            </li>
            <li>
                <a class='hover:text-blue-600' href='{{ $link }}'>{{$label}}</a>
            </li>
            @endforeach
        @endisset
    </ul>
</nav>