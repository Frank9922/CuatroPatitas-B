<?php

namespace Database\Seeders;

use App\Models\Mascota;
use App\Models\Raza;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'nombreCompleto' => 'Franco Leiva',
            'email' => 'francoleiva990@gmail.com',
            'password' => Hash::make('123456789'),
            'provincia' => 'Salta',
            'dni' => '41529213',
            'ciudad' => 'Capital',
            'direccion' => 'Calle el dia 2252'
        ]);

        echo "Usuario insertado \n";

        $response = Http::get(env('API_URL_RAZA'));
        $razas = $response->json();
        $count = 0;
        Raza::create(['name' => 'otros']);
        foreach($razas as $raza) {
            unset($raza['alt_name'], $raza['slug']);
            
            try {
                Raza::create($raza);
                $count++;

            } catch(\Illuminate\Database\QueryException $e) {

            }
        }
        echo "Successfully inserted $count razas records. \n";

        Mascota::factory()->count(100)->create();

        echo "Mascotas insertadas.\n";

    }
}
