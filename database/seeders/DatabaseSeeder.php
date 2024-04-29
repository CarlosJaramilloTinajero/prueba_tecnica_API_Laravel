<?php

namespace Database\Seeders;

use App\Models\Commune;
use App\Models\Customer;
use App\Models\Region;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Creamos el usuario administrador, con el cual se va a hacer el login para los servicios
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminContrasenia')
        ]);

        Region::factory(30)->create();
        Commune::factory(30)->create();
        Customer::factory(70)->create();
    }
}
