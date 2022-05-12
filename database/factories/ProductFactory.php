<?php

namespace Database\Factories;

use App\Models\Company;
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
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'category' => $this->faker->randomElement(['food', 'drink', 'dessert', 'stuff']),
            'weight' => $this->faker->numberBetween(1, 20),
            'description' => $this->faker->sentence,
            'company_id' => Company::factory()
        ];
    }
}
