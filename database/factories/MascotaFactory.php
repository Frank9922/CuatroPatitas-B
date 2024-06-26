<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use PhpParser\Node\Expr\Cast\String_;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mascota>
 */
class MascotaFactory extends Factory
{
    public function generateRandomSexo() : string {
        $options = ['macho', 'hembra'];

        return $options[random_int(0, count($options) - 1)];
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombreFantasia' => fake()->firstName(),
            'edad' => 10,
            'raza_id' => 10,
            'sexo' => $this->generateRandomSexo(),
            'descripcion' => fake()->text(),
            'galeriaFotos' => fake()->url(),
            'user_id' => 1,
            'adoptada' => false,
        ];
    }


}
