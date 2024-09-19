<?php

namespace Database\Factories;

use App\Models\Raza;
use App\Models\Refugio;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;
use PhpParser\Node\Expr\Cast\String_;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mascota>
 */
class MascotaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
    */
    public function definition(): array
    {   

        $isUser = fake()->boolean();

        $response = Http::get(env('URL_API_FOTOS'));
        $data = $response->json();

        $fotoUrl = $data['message'];


        return [
            'nombreFantasia' => fake()->firstName(),
            'edad' => fake()->numberBetween(1, 250),
            'raza_id' => Raza::inRandomOrder()->first()?->id,
            'sexo' => fake()->randomElement(['macho', 'hembra']),
            'descripcion' => fake()->text(),
            'galeriaFotos' => $fotoUrl,
            'publicable_type' => $isUser ? User::class : Refugio::class, 
            'publicable_id' => $isUser ? User::inRandomOrder()->first()?->id : Refugio::inRandomOrder()->first()?->id,
        ];


    }


}
