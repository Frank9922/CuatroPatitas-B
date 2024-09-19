<?php

namespace Database\Seeders;

use App\Models\Mascota;
use App\Models\Refugio;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MascotasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */



    public function run(): void
    {
        Mascota::factory()->count(30)->create();
    }
}
