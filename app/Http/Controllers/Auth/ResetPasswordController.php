<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    public function showResetForm(Request $request, $token = null)
    {   
        return view('auth.passwords.reset', ['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        // Validar los datos enviados por el usuario
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed', // La contraseña debe coincidir con el campo `password_confirmation`
            'token' => 'required',
        ]);

        // Verificar que el token sea válido
        $passwordReset = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->first();

        if (!$passwordReset || !Hash::check($request->token, $passwordReset->token)) {
            return back()->withErrors(['token' => 'El token de restablecimiento de contraseña no es válido.']);
        }

        // Actualizar la contraseña del usuario
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // Eliminar el token de la tabla `password_reset_tokens`
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Redirigir con un mensaje de éxito
        return redirect()->route('login')->with('status', 'Tu contraseña ha sido restablecida con éxito.');
    }

    

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';
}
