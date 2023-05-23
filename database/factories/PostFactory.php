<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->sentence(6),
            'slug' => fake()->slug(4),
            'text' => fake()->paragraphs(4,true),
            'publish_date' => now(),
            'published' => true,
        ];
    }

    /**
     *
     * @return static
     */
    public function unpublished()
    {
        return $this->state(fn () => [
            'published' => false,
        ]);
    }
}
