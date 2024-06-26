<?php  
namespace App\Http\Services;

use App\ApiResponse;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RefugioService {

    public function getRefugios() : JsonResponse {

        try {
        $refugios = User::where('refugio','true')->get();
        
        if(empty($refugios)){
        return ApiResponse::successResponse([
            'refugios' => $refugios
            ]);
        }
        return ApiResponse::successResponse([
            'refugios' => null
        ]);

        } catch (\Exception $e) {
            return ApiResponse::errorResponse($e->getMessage());
        }




    }

}

?>