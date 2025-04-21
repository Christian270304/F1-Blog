<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    /**
     * Verificar el token de acceso.
     */
    public function verifyToken(Request $request)
    {
        try {
            // Intentar autenticar al usuario con el token
            $user = JWTAuth::parseToken()->authenticate();

            return response()->json([
                'status' => 'success',
                'message' => 'Token válido',
                'user' => $user,
            ]);
        } catch (TokenExpiredException $e) {
            // El token ha caducado
            return response()->json([
                'status' => 'error',
                'message' => 'Token expirado',
            ], 401);
        } catch (TokenInvalidException $e) {
            // El token no es válido
            return response()->json([
                'status' => 'error',
                'message' => 'Token inválido',
            ], 401);
        } catch (JWTException $e) {
            // No se proporcionó un token
            return response()->json([
                'status' => 'error',
                'message' => 'Token no proporcionado',
            ], 401);
        }
    }

    public function refreshToken(Request $request)
    {
        try {
            // Refrescar el token
            $newToken = JWTAuth::refresh(JWTAuth::getToken());

            return response()->json([
                'status' => 'success',
                'access_token' => $newToken,
                'token_type' => 'bearer',
                'expires_in' => config('jwt.ttl') * 60, // Tiempo de expiración en segundos
            ]);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se pudo refrescar el token.',
            ], 401);
        }
    }
}
