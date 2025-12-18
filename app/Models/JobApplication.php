<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobApplication extends Model
{
    /** @use HasFactory<\Database\Factories\JobApplicationFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = ['user_id', 'job_id', 'expected_salary', 'cv_path'];

    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function job():BelongsTo{
        return $this->belongsTo(Job::class);
    }

}
