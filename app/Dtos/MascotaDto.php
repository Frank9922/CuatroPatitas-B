<?php

namespace App\Dtos;

class MascotaDto {

    public string $nombreFantasia;
    public int $edad;
    public string $sexo;
    public string $descripcion;
    public string $galeriaFotos;
    public int $user_id;
    public bool $adoptada;
    public int $raza_id;

    public function __construct(array $data)
    {
        $this->nombreFantasia = $data['nombreFantasia'];
        $this->edad = $data['edad'];
        $this->sexo = $data['sexo'];
        $this->descripcion = $data['descripcion'];
        $this->galeriaFotos = $data['galeriaFotos'] ?? '';
        $this->user_id = $data['user_id'];
        $this->adoptada = false;
        $this->raza_id = $data['raza_id'];
    }


    public function toArray(): array
    {
        return [
            'nombreFantasia' => $this->nombreFantasia,
            'edad' => $this->edad,
            'sexo' => $this->sexo,
            'descripcion' => $this->descripcion,
            'galeria_fotos' => $this->galeriaFotos,
            'user_id' => $this->user_id,
            'adoptada' => $this->adoptada,
            'raza_id' => $this->raza_id,
        ];
    }


}

?>