<?php

namespace Database\Factories;

use App\Models\Tenant;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InventoryTransaction>
 */
class InventoryTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $type = fake()->randomElement(['in', 'out', 'adjust']);
        $qty = $type === 'out' ? fake()->numberBetween(-50, -1) : fake()->numberBetween(1, 100);

        return [
            'tenant_id' => Tenant::factory(),
            'product_id' => Product::factory(),
            'qty' => $qty,
            'type' => $type,
            'reference_type' => null,
            'reference_id' => null,
            'notes' => fake()->optional()->sentence(),
        ];
    }
}
