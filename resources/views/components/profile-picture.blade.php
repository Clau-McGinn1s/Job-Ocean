<div>
    <img  {{$attributes->class(['w-10 h-10 rounded-full'])}}
    src="{{route('profile.picture', $path)}}"
    alt="{{$profile ? $profile->name : 'Default'}} Profile Picture"
    />
</div>