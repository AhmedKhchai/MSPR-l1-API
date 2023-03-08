<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\Customer;
use App\Models\Product;
use Dotenv\Repository\AdapterRepository;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orders>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::factory(),
            'product_id' => Product::factory(),
            'quantity' => fake()->numberBetween(0,100)
        ];
    }
}
