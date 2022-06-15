<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'owner' => User::all()->random()->id,
            'city_id' => City::all()->random()->id,
            'slug' => $this->faker->slug(max([1,1])),
            'contact_number' => $this->faker->phoneNumber,
            'opens_at' => $this->faker->time,
            'closes_at' => $this->faker->time,
            'fb_link' => $this->faker->url,
            'ig_link' => $this->faker->url,
            'logo' => $this->faker->imageUrl($width = 200, $height = 120)

        ];
    }
}
