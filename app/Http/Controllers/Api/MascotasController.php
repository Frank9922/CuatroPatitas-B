<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

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
       return $this->mascotasService->mostrarMascotas();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request) : JsonResponse
    {
        return $this->mascotasService->registrarMascota($request->all());
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : JsonResponse
    {
        return $this->mascotasService->mostrarMascota($id);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id) : JsonResponse
    {
        return $this->mascotasService->actualizarMascota($id, $request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : JsonResponse
    {
        return $this->mascotasService->eliminarMascota($id);
    }
}
