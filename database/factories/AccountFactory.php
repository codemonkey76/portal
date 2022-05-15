<?php

namespace Database\Factories;

use App\Models\AccountSubType;
use App\Models\AccountType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $type = AccountType::inRandomOrder()->first();
        return [
            'name' => $this->faker->word,
            'account_type' => $type->name,
            'account_sub_type' => AccountSubType::whereAccountTypeId($type->id)->inRandomOrder()->first()->name,
            'active' => true,
            'sync' => false
        ];
    }
}
