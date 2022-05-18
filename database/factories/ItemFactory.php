<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name'                  => $this->faker->word(),
            'description'           => $this->faker->sentence(),
            'fully_qualified_name'  => '',
            'taxable'               => true,
            'sales_tax_included'    => false,
            'unit_price'            => mt_rand(1,500),
            'type'                  => $this->faker->randomElement(['Category', 'Inventory', 'NonInventory', 'Service']),
            'income_account_ref'    => '',
            'purchase_tax_included' => false,
            'purchase_cost'         => '',
            'expense_account_ref'   => '',
            'sales_tax_code_ref'    => '',
            'purchase_tax_code_ref' => '',
            'sync'                  => false,
        ];
    }
}
