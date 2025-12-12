<nav {{$attributes->class(['container rounded-t-lg rounded-b-lg text-black bg-cyan-600 pl-5 max-w-4xl'])}}>
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