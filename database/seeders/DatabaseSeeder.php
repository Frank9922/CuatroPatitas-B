<?php

namespace Database\Seeders;

use App\Models\Raza;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

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
        echo "Successfully inserted $count razas records.";
    }
}
