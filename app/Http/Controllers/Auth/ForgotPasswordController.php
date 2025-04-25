<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Notifications\CustomResetPassword;



class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */


    public function showLinkRequestForm()
    {
        return view('auth.passwords.email');
    }

    public function sendResetLinkEmail(Request $request)
{
    // Validar el correo electrónico
    $request->validate([
        'email' => 'required|email|exists:users,email', // Verifica que el correo exista en la tabla 'users'
    ]);

    $user = User::where('email', $request->email)->first();

    $token = Str::random(64);

    // Guardar el token en la tabla `password_reset_tokens`
    DB::table('password_reset_tokens')->updateOrInsert(
        ['email' => $user->email],
        [
            'email' => $user->email,
            'token' => Hash::make($token), // Encriptar el token por seguridad
            'created_at' => now(),
        ]
    );

    // Enviar la notificación personalizada
    $user->notify(new CustomResetPassword($token));

    // Redirigir con un mensaje de éxito
    return back()->with('status', 'Hemos enviado un enlace para restablecer tu contraseña a tu correo electrónico.');
}
}
