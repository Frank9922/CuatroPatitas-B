<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    use HasFactory;

    protected $fillable = ['nombreFantasia', 'edad', 'raza', 'sexo', 'descripcion', 'user_id', 'galeriaFotos'];

    
}
