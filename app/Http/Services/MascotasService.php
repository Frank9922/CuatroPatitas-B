<?php 

namespace App\Http\Services;

use App\ApiResponse;
use App\Models\Mascota;
use Illuminate\Http\JsonResponse;

class MascotasService {

    public function mostrarMascotas() : JsonResponse {

        return ApiResponse::successResponse([
            'mascotas' => 'xd'
        ]);

    }

    public function registrarMascota(array $data) : JsonResponse {

        if(!$mascota = Mascota::create($data)) {
             return ApiResponse::errorResponse([
                'message' => 'Hubo un error al registrar la mascota.'
            ]);
        }

        return ApiResponse::successResponse([
            'message' => 'Mascota registrada',
            'mascota' => $mascota
            
        ]);

    }

    public function mostrarMascota(string $id) : JsonResponse {

        return ApiResponse::successResponse([
            'message' => 'Mostrar mascota',
            'mascota' => $id
        ]);

    }

    public function actualizarMascota(string $id, array $data) : JsonResponse {

        return ApiResponse::successResponse([
            'message' => 'Success',
            'mascota' => $data
        ]);

    }

    public function eliminarMascota(string $id) : JsonResponse {
        
        return ApiResponse::successResponse([
            'message' => 'Success',
            'id'    => $id
        ]);

    }

}
?>