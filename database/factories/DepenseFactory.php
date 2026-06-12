<?php

namespace Database\Factories;

use App\Enums\ExpenseCategory;
use App\Models\Depense;
use App\Models\Recu;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepenseFactory extends Factory
{
    protected $model = Depense::class;

    public function definition(): array
    {
        return [
            'name' => fake()->word(),
            'quantity' => fake()->numberBetween(1, 10),
            'price' => fake()->randomFloat(2, 1, 100),
            'categorie' => fake()->randomElement(ExpenseCategory::cases()),
            'recu_id' => Recu::factory(),
        ];
    }
}
