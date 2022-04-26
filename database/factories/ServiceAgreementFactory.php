<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ServiceAgreement>
 */
class ServiceAgreementFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $term = [1,6,12,24,48,36][mt_rand(0,5)];
        return [
            'created_at' => now(),
            'starts_at' => now(),
            'ends_at' => now()->addMonths($term),
            'amount' => mt_rand(20, 400),
            'term' => $term,
            'frequency' => [1, 4, 12][mt_rand(0,2)]
        ];
    }
}
