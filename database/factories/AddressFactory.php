<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'line1' => $this->faker->streetAddress(),
            'city' => $this->faker->city(),
            'state' => $this->faker->randomElement(['QLD', 'NSW', 'ACT', 'VIC', 'TAS', 'NT', 'SA', 'WA']),
            'postal_code' => strval(mt_rand(1000,9999)),
            'lat' => $this->faker->latitude(),
            'long' => $this->faker->longitude(),
            'note' => $this->faker->paragraph(),
        ];
    }
}
