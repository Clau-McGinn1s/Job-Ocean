<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Job extends Model
{
    /** @use HasFactory<\Database\Factories\JobFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'positions';
    protected $fillable = [
        "title", 
        "description",
        "location",
        "salary",
        "category",
        "experience"
    ];

    public static array $experienceLevel = ['entry', 'intermediate', 'senior'];
    public static array $jobCategory = ['IT', 'Marketing', 'Education', 'Health', 'Service', 'Retail', 'Administration', 'Design', 'Logistics'];

    public function employer():BelongsTo{
        return $this->belongsTo(Employer::class);
    }

    public function jobApplications():HasMany{
        return $this->hasMany(JobApplication::class);
    }

    public function scopeFilter(Builder | QueryBuilder $query, array $filters):Builder | QueryBuilder{
        
        $query->when($filters['search'] ?? null, fn($query, $search) => 
            $query->where(function ($query) use($search){
                $query->where('title', 'like', '%' . $search. '%')
                ->orWhere('description', 'like', '%' . $search . '%')
                ->orWhere('location', 'like', '%' . $search . '%')
                ->orWhereHas('employer', function ($q) use ($search) {
                    $q->where('company_name', 'like', '%' . $search . '%');
                });
            }))
        ->when($filters['min_salary'] ?? null, fn($query, $min_salary) => 
            $query->where('salary', '>=', (int)$min_salary))
        ->when($filters['max_salary'] ?? null, fn($query, $max_salary) =>
            $query->where('salary', '<=', (int)$max_salary ))
        ->when($filters['experience'] ?? null, fn($query, $experience)=>
            $query->where('experience' , $experience))
        ->when($filters['category'] ?? null, fn($query, $category)=>
            $query->where('category', $category));
    
        return $query;
    }

    public function hasUserApplied(Authenticatable|User|int $user) : bool 
    {
        return $this->where('id', $this->id)->
            whereHas(
                'jobApplications',
                fn($query) => $query->where('user_id', $user->id ?? $user)
            )->exists();
    }

    public function isUserEmployer(Authenticatable|User|int $user) : bool 
    {
        return $this->employer->where('user_id', $user->id ?? $user)->exists();
    }
}