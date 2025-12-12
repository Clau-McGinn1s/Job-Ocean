<div class='relative'>
    @if ($useRef)
        <button type='button' class="absolute top-0 right-2 text-slate-400 font-light"
            @click="$refs['input-{{$name}}'].value = ''; $refs['form'].submit();">
            <i class="fa-solid fa-xmark"></i>
        </button>
    @endif
    @if($type === 'password')
        <div x-data="{show: false}">
            <button type='button' class="absolute top-0 right-2 text-slate-400 font-light"
                @click="show = !show">
                <template x-if="!show">
                    <i class="fa-regular fa-eye"></i>
                </template>
                 <template x-if="show">
                    <i class="fa-regular fa-eye-slash"></i>
                </template>
            </button>
            
            <input x-ref="input-{{$name}}" 
                :type="show ? 'text' : 'password'"
                placeholder='{{ $placeholder }}'
                name='{{ $name }}' 
                value='{{ $value }}' 
                id="{{ $name }}"
            {{$attributes->class(['w-full text-white rounded-lg border-0 pl-2 bg-cyan-800 ring-1 ring-cyan-600 placeholder:text-slate-400 focus:ring-2 pr-8'])}}
            />
        </div>
        
    @else
         <input x-ref="input-{{$name}}" 
            type={{$type}} 
            placeholder='{{ $placeholder }}'
            name='{{ $name }}' 
            value='{{ $value }}' 
            id="{{ $name }}"
            {{$attributes->class(['w-full text-white rounded-lg border-0 pl-2 bg-cyan-800 ring-1 ring-cyan-600 placeholder:text-slate-400 focus:ring-2 pr-8'])}}
        />
    @endif
   

</div>