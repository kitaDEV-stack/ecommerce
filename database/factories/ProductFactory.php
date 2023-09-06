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
            'title' => fake()->sentence(2),
            'description' => fake()->sentence(5),
            'price' => fake()->numberBetween(100-500),
            'discount_price' => fake()->numberBetween(100-500),
            'quantity' => fake()->numberBetween(100-500),
            'category' => fake()->sentence(2),
        ];
    }
}
