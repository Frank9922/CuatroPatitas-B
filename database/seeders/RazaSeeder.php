<?php

namespace Database\Seeders;

use App\Models\Raza;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class RazaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
        
        echo "Insertado correctamente la cantidad de  $count razas. \n";
    }
}
