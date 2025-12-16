<nav {{$attributes->class(['container rounded-t-lg rounded-b-lg text-black pl-5 max-w-4xl border-2 border-blue-800'])}}>
    <ul class='flex space-x-1'>
        <li> 
            <a class='hover:text-cyan-400' href="/">Home</a>
        </li>
        @isset($links)
            @foreach ($links as $label => $link )
            <li>
                <i class="fa-solid fa-chevron-right"></i>
            </li>
            <li>
                <a class='hover:text-cyan-400' href='{{ $link }}'>{{$label}}</a>
            </li>
            @endforeach
        @endisset
    </ul>
</nav>