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
            "title"         => $this->faker->text(24),
            "body"          => $this->faker->realText(),
            "category_id"   => $this->faker->numberBetween(1, 10),
            "user_id"       => $this->faker->numberBetween(1, 10),
            "image_path"    => $this->faker->imageUrl()
        ];
    }
}
