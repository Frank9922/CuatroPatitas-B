<?php 

namespace App\Http\Services;

use App\ApiResponse;
use App\Jobs\SendRefugioRegistrationEmail;
use App\Jobs\SendUserRegistrationEmail;
use App\Models\Refugio;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthService {

    public function registrarRefugio(array $data) : JsonResponse {

        if(!$refugio = Refugio::create($data)) return ApiResponse::errorResponse('Hubo un error al registrar el usuario');
        
        try {

            SendRefugioRegistrationEmail::dispatch($refugio);

            return ApiResponse::successResponse([
                'message' => 'Registro exitoso!',
                'refugio' => $refugio,
                'email' => 'Se envio un mail de verificaion al usuario'
            ]);

        } catch (\Exception $e) {

            return ApiResponse::successResponse([
                'message' => 'Registro exitoso!',
                'refugio' => $refugio,
                'email' => 'No se pudo enviar el mail de verificacion'
            ], 201);

        }
    }

    public function registrarUsuario(array $data) : JsonResponse {

        if(!$user = User::create($data)) {

            return ApiResponse::errorResponse('Hubo un error al registrar el usuario.');

        }
        
        try {
            
            SendUserRegistrationEmail::dispatch($user);

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

    public function login(array $data): JsonResponse
    {
        $user = User::where('email', $data['email'])->first();

        if ($user) {
            return $this->attemptLogin($data, $user, 'user');
        }

        $refugio = Refugio::where('email', $data['email'])->first();

        if ($refugio) {
            return $this->attemptLogin($data, $refugio, 'refugio');
        }

        return ApiResponse::errorResponse('Email y contraseña incorrectas');
    }

    private function attemptLogin(array $data, User|Refugio $model, string $type): JsonResponse
    {
        if ($type === 'user') {
            if (!Auth::attempt($data)) {
                return ApiResponse::errorResponse('Email y contraseña incorrectas');
            }
        } elseif ($type === 'refugio') {
            if (!Hash::check($data['password'], $model->password)) {
                return ApiResponse::errorResponse('Email y contraseña incorrectas');
            }
            
            Auth::guard('refugio')->login($model);
        }

        $request = request();
        $request->session()->regenerate();

        return ApiResponse::successResponse([
            'message' => 'Login Successfully',
            'model' => $model->getModel(),
            $type => $model
        ]);
    }

    public function logoutUsuario($request) : JsonResponse {
        

        Auth::guard('refugio')->logout();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();


        return ApiResponse::successResponse([
            'message' => 'Logout Successfully',
        ]);


    }


    public function getAuthenticatedUser(Request $request)
    {
        $user = Auth::user() ?? Auth::guard('refugio')->user();

        if($user) {
            $modelType = $user instanceof User ? 'user' : 'refugio';
            return ApiResponse::successResponse([
                'model' => $modelType,
                $modelType => $user
            ]);
        }

        return ApiResponse::errorResponse('Usuario no autenticado');
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