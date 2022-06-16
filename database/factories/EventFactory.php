<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->title(max([1,2])),
            'image' => $this->faker->imageUrl($width = 200, $height = 120),
            'date' => $this->faker->date,
            'company_id' => Company::all()->random()->id
        ];
    }
}
