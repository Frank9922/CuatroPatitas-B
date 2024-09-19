<?php

namespace App\Http\Controllers\Api;

use App\Dtos\MascotaDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdopcionRequest;
use App\Http\Requests\MascotaRequest;
use App\Http\Services\MascotasService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;


class MascotasController extends Controller
{   
    private $mascotasService;

    public function __construct(MascotasService $mascotasService) {

        $this->mascotasService = $mascotasService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
       return $this->mascotasService->todasLasMascotas();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MascotaRequest $request) : JsonResponse
    {   
        $mascota = new MascotaDto($request->all());

        return $this->mascotasService->registrarMascota($mascota);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request) : JsonResponse
    {
        return $this->mascotasService->mostrarMascota($request);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) : JsonResponse
    {   
        $mascota = new MascotaDto($request->all());

        return $this->mascotasService->actualizarMascota($id, $mascota);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : JsonResponse
    {
        return $this->mascotasService->eliminarMascota($id);
    }

    /**
     * Adoptar una mascota
     */
    public function adopcion(AdopcionRequest $request) : JsonResponse 
    {
        return $this->mascotasService->adoptarMascota($request->all());
    }
}
