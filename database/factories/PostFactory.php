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
    public function definition(): array
    {
        return [
            'username' => $this->faker->userName,
            'uuid' => $this->faker->uuid,
            'content' => $this->faker->paragraph(3),
            'comments' => $this->faker->numberBetween(1,10),
            'likes' => $this->faker->numberBetween(1,10),
            'reposts' => $this->faker->numberBetween(1,10),
            'shares' => $this->faker->numberBetween(1,10),
            'timestamp' => $this->faker->dateTimeThisYear
        ];
    }
}
