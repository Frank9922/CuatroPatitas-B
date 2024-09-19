<?php  
namespace App\Http\Services;

use App\ApiResponse;
use App\Models\Refugio;
use App\Models\User;
use Illuminate\Http\JsonResponse;

class RefugioService {

    public function getRefugios() : JsonResponse {

        $refugios = Refugio::all();
        
        
        return ApiResponse::successResponse([
            'refugios' => $refugios
            ]);

    }

}

?>