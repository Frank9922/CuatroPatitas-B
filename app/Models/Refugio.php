<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthAuthenticatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Refugio extends Model implements AuthAuthenticatableContract
{
    use Authenticatable;
    use HasFactory, Notifiable, HasApiTokens;

    protected $table = 'refugios';

    protected $fillable = [
        'nombreCompleto',
        'descripcion',
        'email',
        'celular',
        'provincia',
        'ciudad',
        'direccion',
        'fotosUrl',
        'horarios',
        'token_verificacion',
        'password'
    ];
    
}
