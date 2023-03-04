<?php

namespace Database\Factories;
use App\Models\Address;
use App\Models\Profile;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'username' => fake()->userName(),
            'firstName' => fake()->firstName(),
            'lastName' => fake()->lastName(),
            'email' => fake()->email(),
            'is_client' => fake()->boolean(),
            'address_id' => Address::factory(),
            'profile_id' => Profile::factory(),
            'company_id' => Company::factory(),
        ];
    }
}
