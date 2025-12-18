<div class='relative'>
    @if($type !== "textarea")
        @if ($useRef)
            <button type='button' class="absolute top-0 right-2 text-slate-500 font-light"
                @click="$refs['input-{{$name}}'].value = ''; $refs['form'].submit();">
                <i class="fa-solid fa-xmark"></i>
            </button>
        @endif
        @if($type === 'password')
            <div x-data="{show: false}">
                <button type='button' class="absolute top-0 right-2 text-slate-500 font-light"
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
                    placeholder="{{ $placeholder }}"
                    name="{{ $name }}" 
                    value="{{ old($name, $value) }}"
                    id="{{ $name }}"
                     @class([
                    'w-full text-slate-900 rounded-lg border-0 pl-2 ring-1 placeholder:text-slate-600 focus:ring-2 pr-8',
                    'bg-red-500 border-red-800 ring-red-200' => $errors->has($name),
                    'bg-blue-200 ring-cyan-600 ' => !$errors->has($name)]) 
                />
            </div>
            
        @else
            <input x-ref="input-{{$name}}" 
                type="{{$type}}"
                placeholder="{{ $placeholder }}"
                name="{{ $name }}" 
                value="{{ old($name, $value) }}"
                id="{{ $name }}"
                @class([
                    'w-full text-slate-900 rounded-lg border-0 pl-2 ring-1 placeholder:text-slate-600 focus:ring-2',
                    'bg-red-500 border-red-800 ring-red-200' => $errors->has($name),
                    'bg-blue-200 ring-cyan-600 ' => !$errors->has($name),
                    'pr-8' => $useRef]) 
            />
        @endif
    @else
        <textarea
            placeholder="{{ $placeholder }}"
            name="{{ $name }}" 
            id="{{ $name }}"
            @class([
                'w-full text-slate-900 rounded-lg border-0 pl-2 ring-1 placeholder:text-slate-600 focus:ring-2',
                'bg-red-500 border-red-800 ring-red-200' => $errors->has($name),
                'bg-blue-200 ring-cyan-600 ' => !$errors->has($name)]) 
        >{{ old($name, $value) }}</textarea>
    @endif
    
        
    @error($name)
        <div class="text-red-700 text-xs">
            {{ $message }}
        </div>
    @enderror

</div>