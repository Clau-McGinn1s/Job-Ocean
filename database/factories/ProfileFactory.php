<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "title" => fake()->jobTitle(),
            "picture_path" => fake()->randomElement([null, "pp/A.jpg", "pp/B.jpg", "pp/C.jpg"]), 
            "about" => fake()->text(500),
            "location" =>fake()->city(),
            "category_1" => fake()->randomElement(\App\Models\Job::$jobCategory),
            "category_2" => fake()->randomElement(\App\Models\Job::$jobCategory),
            "category_3" => fake()->randomElement(\App\Models\Job::$jobCategory)
        ];
    }
}
