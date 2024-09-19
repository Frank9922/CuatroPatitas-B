<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Refugio>
 */
class RefugioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre_completo' => fake()->company(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'provincia' => fake()->state(),
            'ciudad' => fake()->city(),
            'direccion' => fake()->name(),
            'horario' => fake()->name(),
            'descripcion' => fake()->streetAddress(),
            'fotoUrl' => fake()->imageUrl(),
            'galeriaFotos' => fake()->name(),
            'token_verification' => Str::random(40)
        ];
    }
}
