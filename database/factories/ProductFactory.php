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
        $categories = ['Electronics', 'Furniture', 'Stationery', 'Food & Beverage', 'Clothing'];
        $cost = fake()->randomFloat(2, 10, 500);
        $price = $cost * fake()->randomFloat(2, 1.3, 2.5);

        return [
            'name' => fake()->words(3, true),
            'sku' => strtoupper(fake()->bothify('SKU-####??')),
            'price' => round($price, 2),
            'cost' => round($cost, 2),
            'stock' => fake()->numberBetween(0, 100),
            'min_stock' => fake()->numberBetween(5, 20),
            'category' => fake()->randomElement($categories),
            'description' => fake()->optional()->sentence(),
        ];
    }
}
