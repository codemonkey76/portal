<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VoipServer>
 */
class VoipServerFactory extends Factory
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
            'server_url' => $this->faker->url(),
            'api_user' => $this->faker->email(),
            'api_password' => $this->faker->password(),
            'active' => true
        ];
    }
}
