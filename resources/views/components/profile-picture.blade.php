<div>
    <img  {{$attributes->class(['min-w-10 max-w-10 min-h-10 max-h-10 rounded-full'])}}
    src="{{route('profile.picture', $path)}}"
    alt="{{$profile ? $profile->name : 'Default'}} Profile Picture"
    />
</div>