<?php

namespace Database\Seeders;

use App\Models\Raza;
use App\Models\User;
use Carbon\Carbon;
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

        $this->call(UserSeeder::class);
        $this->call(RefugioSeeder::class);
        $this->call(RazaSeeder::class);

        User::create([
            'nombreCompleto' => 'Franco Leiva',
            'email' => 'francoleiva990@gmail.com',
            'dni' => '41529213',
            'password' => Hash::make('123456789'),
            'fotoUrl' => fake()->imageUrl(),
            'email_verified_at' => Carbon::now()
        ]);

        echo "Usuario insertado francoleiva990@gmail.com\n";
        

        $this->call(MascotasSeeder::class);
        

    }
}
