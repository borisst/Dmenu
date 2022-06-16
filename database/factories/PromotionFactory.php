<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Promotion>
 */
class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws \Exception
     */
    public function definition()
    {
        return [
            'name' => $this->faker->title(max([1, 2])),
            'image' => $this->faker->imageUrl($width = 200, $height = 120),
            'date' => $this->faker->date,
            'company_id' => Company::all()->random()->id,
            'price' => random_int(1000, 9999),
            'event_id' => Event::all()->random()->id

        ];
    }
}
