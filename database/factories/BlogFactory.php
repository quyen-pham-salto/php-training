<?php

namespace Database\Factories;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BlogFactory extends Factory
{
    protected $model = Blog::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => fake()->numberBetween(1,50),
            'title' => fake()->text(30),
            'body' => fake()->text(500),
            'photo_name' => fake()->word(),
            'created_at' => fake()->datetime($max = 'now', $timezone = date_default_timezone_get()),
            'updated_at' => fake()->datetime($max = 'now', $timezone = date_default_timezone_get())
        ];
    }
}
