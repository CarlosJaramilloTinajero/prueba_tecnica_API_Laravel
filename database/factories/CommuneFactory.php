<?php

namespace Database\Factories;

use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Commune>
 */
class CommuneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Buscamos una region que este activa
        $region = Region::where('status', 'A')->inRandomOrder()->first();

        // Si no existe ni uno lo creamos
        if (!$region) {
            $region = Region::factory()->create([
                'status' => 'A'
            ]);
        }

        return [
            'id_reg' => $region->id_reg,
            'description' => fake()->sentence(),
            'status' => fake()->randomElement(['A', 'I', 'trash'])
        ];
    }
}
