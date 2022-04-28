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
            'abn' => number_format(strval(mt_rand(10000000000,99999999999)), 0, '', ' '),
            'display_name' => $company,
            'fully_qualified_name' => $company,
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'billing_address' => $this->faker->streetAddress(),
            'billing_suburb' => $this->faker->city(),
            'billing_state' => $this->faker->randomElement(['ACT', 'NSW', 'TAS', 'VIC', 'QLD', 'NT', 'SA', 'WA']),
            'billing_postcode' => strval(mt_rand(1000, 9999)),
            'billing_country' => 'Australia'
        ];
    }
}
