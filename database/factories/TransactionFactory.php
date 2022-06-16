<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'type' => 'invoice',
            'transaction_date' => now()->subDays(mt_rand(0,30))
        ];
    }

    public function payment()
    {
        return $this->state(function(array $attributes) {
           return [
               'type' => 'payment'
           ];
        });
    }
}
