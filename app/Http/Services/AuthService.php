<?php 

namespace App\Http\Services;

use App\ApiResponse;
use App\Jobs\SendRegistrationEmail;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthService {

    public function registrarUsuario(array $data) : JsonResponse {

        if(isset($data['refugio'])){
            unset($data['dni']);
        } else {
            unset($data['horario'], $data['descripcion'], $data['refugio']);
        }

        // Creo el usuario 
        if(!$user = User::create($data)) {

            return ApiResponse::errorResponse('Hubo un error al registrar el usuario.');

        }
        //Mando Mail para verificar el usuario
        try {
            

            SendRegistrationEmail::dispatch($user);

            return ApiResponse::successResponse([
                'message' => 'Registro exitoso!',
                'usuario' => $user,
                'email' => 'Se envio un mail de verificacion al usuario.'
            ], 201);

        } catch (\Exception $e) { 
            return ApiResponse::successResponse([
                'message' => 'Registro exitoso!',
                'usuario' => $user,
                'email' => 'No se pudo enviar el mail de verificacion'
            ], 201);

        }


    }

    public function loginUsuario(array $data) : JsonResponse {

        if(!Auth::attempt($data)) {
            return ApiResponse::errorResponse('Email y contraseña incorrectas');
        }

       $user = User::where('email', $data['email'])->first();
        

        return ApiResponse::successResponse([
            'message' => 'Login Successfully',
            'user' => $user,
            'token' => $user->createToken("API_TOKEN")->plainTextToken
        ]);

    }

    public function logoutUsuario($request) : JsonResponse {
        
       auth()->user()->tokens()->delete();

        return ApiResponse::successResponse([
            'message' => 'Logout Successfully',
        ]);


    }


    public function getUser($request) : JsonResponse {

        return ApiResponse::successResponse([
            'message' => 'Get User Successfully',
            'user' => $request->user()
        ]);
    }

    public function verifyEmail($token) : JsonResponse {

        if(!$user = User::where('token_verificacion', $token)->first()) {

            return ApiResponse::errorResponse('El token no es valido');
        }

        try {
            $user->email_verified_at = now();
            $user->token_verificacion = null;
            $user->save();

        } catch (\Exception $e) {

            return ApiResponse::errorResponse($e->getMessage());
        }

        return ApiResponse::successResponse([
            'ok'      => true,
            'message' => 'Verificacion exitosa'
        ]);
        
    }
}

?>