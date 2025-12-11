<div class='relative'>
    <button type='button' class="absolute top-0 right-2 text-slate-400 font-light"
        @click="$refs['input-{{$name}}'].value = ''; $refs['form'].submit();">
        <i class="fa-solid fa-xmark"></i>
    </button>
    <input x-ref="input-{{$name}}" type='text' placeholder='{{ $placeholder }}'
    name='{{ $name }}' value='{{ $value }}' id="{{ $name }}"
    {{$attributes->class(['w-full rounded-xl border-0 pl-2 bg-cyan-800 ring-1 ring-cyan-600 placeholder:text-slate-400 focus:ring-2 pr-8'])}}/>

</div>