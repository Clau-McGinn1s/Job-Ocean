<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory;

    protected $table = 'positions';

    public static array $experienceLevel = ['entry', 'intermediate', 'senior'];
    public static array $jobCategory = ['IT', 'Marketing', 'Education', 'Health', 'Service', 'Retail', 'Administration', 'Design', 'Logistics'];
}
