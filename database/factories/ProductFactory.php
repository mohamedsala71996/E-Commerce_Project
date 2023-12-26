<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'store_id' => \App\Models\Store::factory()->create()->id,
            'category_id' => \App\Models\Category::factory()->create()->id,
            'name' => $this->faker->unique()->words(2, true),
            'slug' => $this->faker->unique()->slug,
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(),
            'price' => $this->faker->randomFloat(2, 10, 100),
            'compare_price' => $this->faker->optional()->randomFloat(2, 100, 200),
            'options' => json_encode(['option1' => 'value1', 'option2' => 'value2']),
            'rating' => $this->faker->randomFloat(1, 0, 5),
            'featured' => $this->faker->boolean,
            'status' => $this->faker->randomElement(['active', 'archived', 'draft']),

        ];
    }
}
