<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Mascota extends Model
{
    use HasFactory;

    protected $fillable = ['nombreFantasia', 'edad', 'raza', 'sexo', 'descripcion', 'user_id', 'galeriaFotos'];

    public function duenio() : BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function raza() : BelongsTo {
        return $this->belongsTo(Raza::class, 'raza_id');
    }
}
