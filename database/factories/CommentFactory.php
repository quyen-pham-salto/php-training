<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Comment;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class CommentFactory extends Factory
{
    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => fake()->numberBetween(1,50),
            'blog_id' => fake()->numberBetween(1,200),
            'display_name' => fake()->word(),
            'comment' => fake()->text(150),
            'created_at' => fake()->datetime($max = 'now', $timezone = date_default_timezone_get()),
            'updated_at' => fake()->datetime($max = 'now', $timezone = date_default_timezone_get())
        ];
    }
}
