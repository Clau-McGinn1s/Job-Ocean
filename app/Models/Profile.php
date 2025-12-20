<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    /** @use HasFactory<\Database\Factories\ProfileFactory> */
    use HasFactory;

    protected $fillable = [
        "user_id",
        "name", 
        "picture_path",
        "type", 
        "about",
        "location",
        "category_1",
        "category_2",
        "category_3"
    ];

    public static array $profileType = ["personal", "company"];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isUserTheOwner(Authenticatable|User|int $user) : bool 
    { 
        return $this->user_id === $user->id || $this->user_id === $user;
    }
}
