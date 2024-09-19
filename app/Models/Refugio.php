<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Refugio extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    public function mascotas() : MorphMany {
        return $this->morphMany(Mascota::class, 'publicable');
    }

    public function getModel() : string {
        return 'Refugio';
    }
    
}
