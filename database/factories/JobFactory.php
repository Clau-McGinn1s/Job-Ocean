<?php

namespace Database\Factories;

use App\Models\Job;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->jobTitle(),
            'description' => fake()->paragraph(6, true),
            'salary' => fake()->numberBetween(5_000, 300_000),
            'location' => fake()->city(),
            'category' => fake()->randomElement(Job::$jobCategory),
            'experience' => fake()->randomElement(Job::$experienceLevel)
        ];
    }
}
