<?php

namespace Database\Seeders;

use App\Models\Depense;
use App\Models\Recu;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::factory(5)
            ->has(Recu::factory(3)->has(Depense::factory(5), 'Depenses'), 'Recus')
            ->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
