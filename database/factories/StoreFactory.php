<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Store>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->company,
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->paragraph,
            'logo_image' => $this->faker->imageUrl(),
            'cover_image' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['active', 'inactive']),

        ];
    }
}
