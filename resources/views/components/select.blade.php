<div>
    <select name="{{$name}}" id="{{$name}}"
    @class([
        'w-full text-slate-900 rounded-lg border-0 pl-2 ring-1 placeholder:text-slate-600 focus:ring-2',
        'bg-red-500 border-red-800 ring-red-200' => $errors->has($name),
        'bg-blue-200 ring-cyan-600 ' => !$errors->has($name)])
    >
        <option value=""> SELECT AN OPTION</option>
        @foreach ($options as $option)
            <option @selected(old($name, $value) == $option) value="{{$option}}">{{Str::upper($option)}}</option>
        @endforeach
    </select>
    @error($name)
        <div class="text-red-700 text-xs">
            {{ $message }}
        </div>
    @enderror
</div>
