<?php

namespace Database\Factories;

use App\Enums\ReceiptStatus;
use App\Models\Recu;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecuFactory extends Factory
{
    protected $model = Recu::class;

    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'text_brut' => fake()->paragraph(3),
            'status' => fake()->randomElement(ReceiptStatus::cases()),
            'json' => [],
            'user_id' => User::factory(),
        ];
    }
}
