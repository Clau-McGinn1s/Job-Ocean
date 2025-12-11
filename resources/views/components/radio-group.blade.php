<div class="my-1 font-bold" >{{Str::ucfirst($name)}}
    <span {{ $attributes->class(['flex space-x-3']) }}>
        {{-- Default case --}}
        <label for="{{$name}}" class='mb-1 flex items-center'>
            <input type="radio" name="{{$name}}" value="" @checked(!request($name))
            class='appearance-none w-3 h-3 rounded-full border border-cyan-700 checked:bg-blue-700 checked:border-blue-700'/>
            <span class='ml-1'
            
            >{{Str::ucfirst($default)}}</span>
        </label>
        @foreach ($options as $option)
            <label for="{{$name}}" class='mb-1 flex items-center'>
                <input type="radio" name="{{$name}}" value="{{$option}}" @checked(request($name) === $option)
                 class='appearance-none w-3 h-3 rounded-full border border-cyan-700 checked:bg-blue-700 checked:border-blue-700'/>
                <span class='ml-1'>
                    {{Str::ucfirst($option)}}
                </span>
            </label>
        @endforeach
        
    </span>
</div>