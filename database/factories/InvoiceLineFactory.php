<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\InvoiceLine>
 */
class InvoiceLineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'detail_type' => 'SalesItemLineDetail',
            'amount' => 0
        ];
    }

    public function subtotal(): InvoiceLineFactory
    {
        return $this->state(function(array $attributes) {
            return ['detail_type' => 'SubTotalLineDetail'];
        });
    }
}
