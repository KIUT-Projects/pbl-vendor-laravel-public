<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderItem>
 */
class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::random()->first();
        return [
            'order_id' => Order::all()->random()->id,
            'product_id' => $product->id,
            'quantity' => mt_rand(1, 4),
        ];
    }
}
