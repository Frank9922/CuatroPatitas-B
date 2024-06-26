<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Adopcion extends Model
{
    use HasFactory;

    protected $fillable = ['idMascota', 'idNuevoDuenio', 'idAntiguoDuenio', 'descripcion', 'fechaAdopcion', 'fotosTestigo'];
    
}
