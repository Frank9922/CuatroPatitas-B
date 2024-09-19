<?php 

namespace App\Http\Services;

use App\ApiResponse;
use App\Dtos\MascotaDto;
use App\Models\Adopcion;
use App\Models\Mascota;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MascotasService {

    public function todasLasMascotas() : JsonResponse {

        $mascotas = Mascota::with('raza')->get();

        return ApiResponse::successResponse([
            'mascotas' => $mascotas
        ]);

    }

    public function registrarMascota(MascotaDto $mascotaDto) : JsonResponse {

        if(!$mascota = Mascota::create($mascotaDto->toArray())) {
             return ApiResponse::errorResponse('Hubo un error al registrar la mascota.');
        }

        return ApiResponse::successResponse([
            'message' => 'Mascota registrada',
            'mascota' => $mascota
            
        ]);

    }

    public function mostrarMascota(Request $request) : JsonResponse {

        $user = User::find($request->user()->id);

        dd($user);        

        $mascotas = Mascota::where('publicable_type', );

        return ApiResponse::successResponse([
            'message' => 'Mascotas del usuario '. $user->nombreCompleto . '.',
            'mascotas' => $mascotas
        ]);

    }

    public function actualizarMascota(string $id, MascotaDto $mascotaDto) : JsonResponse {
        
        if(!$mascota = Mascota::where('id', $id)->first()) {
            
            return ApiResponse::errorResponse('Mascota not found');

        }

        DB::beginTransaction();
        try {

            $mascota->update($mascotaDto->toArray());
            DB::commit();
            return ApiResponse::successResponse([
                'message' => 'Success',
                'mascota' => $mascota
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return ApiResponse::errorResponse($e->getMessage());
        }

    }

    public function eliminarMascota(string $id) : JsonResponse {
        
        if(!$mascota = Mascota::where('id', $id)->first()) {
            
            return ApiResponse::errorResponse('Mascota not found');

        }

        DB::beginTransaction();
        try {
            $mascota->delete();

            DB::commit();

            return ApiResponse::successResponse([
                'message' => 'Success'
            ]);

            

        } catch (\Exception $e) {
            DB::rollBack();

            return ApiResponse::errorResponse($e->getMessage());
            
        }

    }

    public function adoptarMascota(array $data) : JsonResponse {

        $mascota = Mascota::find($data['idMascota']);

        if($mascota->user_id !== auth()->user()->id) return ApiResponse::errorResponse('No tiene privilegios sobre esta mascota');

        if($mascota->adoptada == true) return ApiResponse::errorResponse('Esta mascota ya esta adoptada');

        DB::beginTransaction();
        try {

            $data['fechaAdopcion'] = now();
            $adopcion = Adopcion::create($data);
            $mascota->adoptada = true;
            $mascota->save();

            DB::commit();

            return ApiResponse::successResponse([
                'message' => 'Adopcion finalizada!',
                'adopcion' => $adopcion
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return ApiResponse::errorResponse($e->getMessage());

        }
        
    }
}
?>