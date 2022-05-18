<?php

namespace Database\Factories;

use App\Models\NetworkCarrier;
use App\Models\ServiceType;
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
        $serviceType = ServiceType::inRandomOrder()->first();
        $speed = $serviceType->speeds()->inRandomOrder()->first();
        return [
            'description' => $this->faker->word(),
            'speed' => $speed->shortSpeedString,
            'service_id' => strval(mt_rand(100000,1000000)),
            'service_type' => $serviceType->name,
            'carrier' => NetworkCarrier::inRandomOrder()->first()->name,
            'username' => $this->faker->userName(),
            'password' => $this->faker->password(),
            'ip_address' => $this->faker->ipv4(),
            'end_user' => $this->faker->name(),
            'site_name' => $this->faker->company(),
            'site_address' => $this->faker->address(),
            'price' => $speed->price
        ];
    }
}
