<?php

namespace Database\Factories;

use App\Models\Tenant;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $subtotal = fake()->randomFloat(2, 100, 5000);
        $discount = fake()->randomFloat(2, 0, $subtotal * 0.1);
        $tax = ($subtotal - $discount) * 0.11; // 11% tax
        $total = $subtotal - $discount + $tax;

        return [
            'tenant_id' => Tenant::factory(),
            'customer_id' => Customer::factory(),
            'title' => fake()->optional()->sentence(4),
            'reference' => fake()->optional()->bothify('REF-####'),
            'subtotal' => round($subtotal, 2),
            'discount' => round($discount, 2),
            'tax' => round($tax, 2),
            'total' => round($total, 2),
            'status' => fake()->randomElement(['draft', 'pending', 'paid']),
            'due_date' => fake()->dateTimeBetween('now', '+30 days'),
            'payment_method' => fake()->randomElement(['cash', 'transfer', 'card', 'giro']),
        ];
    }
}
