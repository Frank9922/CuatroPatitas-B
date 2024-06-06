<?php 

namespace App\Http\Services;

use App\Jobs\SendRegistrationEmail;
use App\Models\Refugio;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class AuthRefugioService {

    private $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }


    public function registrarRefugio(array $data) : JsonResponse {

        // Creo el Refugio 
        if(!$refugio = Refugio::create($data)) {

            return $this->responseService->errorResponse([
                'ok' => false,
                'message' => 'Hubo un error al registrar el Refugio.'
            ]);

        }
        //Mando Mail para verificar el Refugio
        try {
            

            SendRegistrationEmail::dispatch($refugio);

            return $this->responseService->successResponse([
                'ok' => true,
                'message' => 'Registro exitoso!',
                'refugio' => $refugio,
                'email' => 'Se envio un mail de verificacion al refugio.'
            ], 201);

        } catch (\Exception $e) { 
            return $this->responseService->successResponse([
                'ok' => true,
                'message' => 'Registro exitoso!',
                'refugio' => $refugio,
                'email' => 'No se pudo enviar el mail de verificacion'
            ], 201);

        }


    }

    public function loginRefugio(array $data) : JsonResponse {

        if($refugio = !Auth::attempt($data)) {
            return $this->responseService->errorResponse([
                'ok' => false,
                'message' => 'Email y contraseña incorrectas'
            ]);
        }

       $refugio = Refugio::where('email', $data['email'])->first();
        

        return $this->responseService->successResponse([
            'ok' => true,
            'message' => 'Login Successfully',
            'refugio' => $refugio,
            'token' => $refugio->createToken("API_TOKEN")->plainTextToken
        ]);

    }

    public function logoutRefugio($request) : JsonResponse {

       auth()->user()->tokens()->delete();

        return $this->responseService->successResponse([
            'ok' => true,
            'message' => 'Logout Successfully',
        ]);


    }


    public function refugio($request) : JsonResponse {

        return $this->responseService->successResponse([
            'ok' => true,
            'message' => 'Get Refugio Successfully',
            'user' => $request->user()
        ]);
    }

    public function verifyEmailRefugio($token) : JsonResponse {

        if(!$refugio =Refugio::where('token_verificacion', $token)->first()) {

            return $this->responseService->errorResponse([
                'ok'      => false,
                'message' => 'El token no es valido'
            ]);
        }

        try {
            $refugio->email_verified_at = now();
            $refugio->token_verificacion = null;
            $refugio->save();

        } catch (\Exception $e) {

            return $this->responseService->errorResponse([
                'ok'      => false,
                'message' => $e->getMessage(),
            ]);
        }

        return $this->responseService->successResponse([
            'ok'      => true,
            'message' => 'Verificacion exitosa'
        ]);
        
    }
}

?>