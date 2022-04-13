<?php

namespace Database\Factories;

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
    public function definition()
    {
        $company = $this->faker->company();

        return [
            'company_name' => $company,
            'display_name' => $company,
            'fully_qualified_name' => $company,
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber()
        ];
    }
}
