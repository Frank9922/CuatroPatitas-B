<?php 

namespace App\Http\Services;

use App\Jobs\SendRegistrationEmail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class AuthService {

    private $responseService;

    public function __construct(ResponseService $responseService)
    {
        $this->responseService = $responseService;
    }


    public function registrarUsuario(array $data) : JsonResponse {

        // Creo el usuario 
        if(!$user = User::create($data)) {

            return $this->responseService->errorResponse([
                'ok' => false,
                'message' => 'Hubo un error al registrar el usuario.'
            ]);

        }
        //Mando Mail para verificar el usuario
        try {
            

            SendRegistrationEmail::dispatch($user);

            return $this->responseService->successResponse([
                'ok' => true,
                'message' => 'Registro exitoso!',
                'usuario' => $user,
                'email' => 'Se envio un mail de verificacion al usuario.'
            ], 201);

        } catch (\Exception $e) { 
            return $this->responseService->successResponse([
                'ok' => true,
                'message' => 'Registro exitoso!',
                'usuario' => $user,
                'email' => 'No se pudo enviar el mail de verificacion'
            ], 201);

        }


    }

    public function loginUsuario(array $data) : JsonResponse {

        if(!Auth::attempt($data)) {
            return $this->responseService->errorResponse([
                'ok' => false,
                'message' => 'Email y contraseña incorrectas'
            ]);
        }

       $user = User::where('email', $data['email'])->first();
        

        return $this->responseService->successResponse([
            'ok' => true,
            'message' => 'Login Successfully',
            'user' => $user,
            'token' => $user->createToken("API_TOKEN")->plainTextToken
        ]);

    }

    public function logoutUsuario($request) : JsonResponse {

       auth()->user()->tokens()->delete();

        return $this->responseService->successResponse([
            'ok' => true,
            'message' => 'Logout Successfully',
        ]);


    }


    public function getUser($request) : JsonResponse {

        return $this->responseService->successResponse([
            'ok' => true,
            'message' => 'Get User Successfully',
            'user' => $request->user()
        ]);
    }

    public function verifyEmail($token) : JsonResponse {

        if(!$user = User::where('token_verificacion', $token)->first()) {

            return $this->responseService->errorResponse([
                'ok'      => false,
                'message' => 'El token no es valido'
            ]);
        }

        try {
            $user->email_verified_at = now();
            $user->token_verificacion = null;
            $user->save();

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