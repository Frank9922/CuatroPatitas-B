<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Mascota extends Model
{
    use HasFactory;

    protected $fillable = ['nombreFantasia', 'edad', 'sexo', 'descripcion', 'publicable', 'galeriaFotos', 'raza_id'];

    public function raza() : BelongsTo {
        return $this->belongsTo(Raza::class, 'raza_id');
    }

    public function publicable() : MorphTo {
        return $this->morphTo();
    }

    
}
