<?php

namespace App\View\Components;

use App\Models\Profile;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Psy\Util\Str;
use Illuminate\Support\Facades\Storage;


class ProfilePicture extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public ?Profile $profile = null,
        public ?string $path = "pp/default.jpg"
    )
    {
        if($this->profile !== null && $this->profile->picture_path !== null){
            $this->path = $this->profile->picture_path;
        }        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.profile-picture');
    }
}
