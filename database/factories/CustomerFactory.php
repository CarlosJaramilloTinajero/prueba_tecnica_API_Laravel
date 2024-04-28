<?php

namespace Database\Factories;

use App\Models\Commune;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Customer>
 */
class CustomerFactory extends Factory
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

        // Seleccionamos el commune que este relacionado con la region
        $commune = Commune::where('status', 'A')->where('id_reg', $region->id_reg)->inRandomOrder()->first();

        // Si no existe ni uno lo creamos
        if (!$commune) {
            $commune = Commune::factory()->create([
                'id_reg' => $region->id_reg,
                'status' => 'A'
            ]);
        }

        return [
            'id_reg' => $region->id_reg,
            'id_com' => $commune->id_com,
            'email' => fake()->email(),
            'name' => fake()->name(),
            'last_name' => fake()->lastName(),
            'address' => fake()->address(),
            'date_reg' => fake()->date(),
            'status' => fake()->randomElement(['A', 'I', 'trash']),
            'dni' => fake()->unique()->numerify('########')
        ];
    }
}
