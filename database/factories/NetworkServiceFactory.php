<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NetworkService>
 */
class NetworkServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'service_id' => strval(mt_rand(100000,1000000)),
            'service_type' => $this->faker->randomElement(['NBN', 'E-Line', 'Fibre']),
            'carrier' => $this->faker->randomElement(['Superloop', 'AAPT', 'Optus']),
            'username' => $this->faker->userName(),
            'password' => $this->faker->password(),
            'ip_address' => $this->faker->ipv4(),
            'end_user' => $this->faker->name(),
            'site_name' => $this->faker->company(),
            'site_address' => $this->faker->address()
        ];
    }
}