<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    public function generateTokens()
    {
        try {
            // Obtener el usuario autenticado
            $user = Auth::user();

            // Generar el token de acceso
            $accessToken = \Tymon\JWTAuth\Facades\JWTAuth::fromUser($user);

            // Generar el refresh token
            $refreshToken = \Tymon\JWTAuth\Facades\JWTAuth::claims(['token_type' => 'refresh'])->fromUser($user);

            // Devolver los tokens como respuesta JSON
            return response()->json([
                'status' => 'success',
                'access_token' => $accessToken,
                'refresh_token' => $refreshToken,
                'token_type' => 'bearer',
                'expires_in' => config('jwt.ttl') * 60, 
            ]);
        } catch (\Throwable $exception) {
            return response()->json([
                'status' => 'error',
                'message' => 'No se pudieron generar los tokens.',
            ], 500);
        }
    }
}
