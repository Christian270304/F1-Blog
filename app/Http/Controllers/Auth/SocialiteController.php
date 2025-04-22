<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class SocialiteController extends Controller
{
    // Redirigir a Google
    public function redirectToGoogle()
    {
        session(['oauth_origin' => url()->previous()]);
        return Socialite::driver('google')->redirect();
    }

    // Manejar la respuesta de Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        if ($user) {
            $user->update([
                'username' => $googleUser->getName(),
                'OAuth' => 1,
                'password' => bcrypt('default_password'),
                'creado_el' => now(),
            ]);
        } else {
            $username = $googleUser->getName();
            if (User::where('username', $username)->exists()) {
                $username = $username . '_' . uniqid(); // Generar un username único
            }

            // Crear un nuevo usuario
            $user = User::create([
                'email' => $googleUser->getEmail(),
                'username' => $username,
                'OAuth' => 1,
                'password' => bcrypt('default_password'),
                'creado_el' => now(),
            ]);
        }

        Auth::login($user);

        return redirect('/myArticles');
        } catch (\Exception $e) {
            $origin = session('oauth_origin', '/login');
            return redirect($origin)->withErrors(['email' => 'Ya existe una cuenta con este correo electrónico.']);
        }
    }

    // Redirigir a GitHub
    public function redirectToGitHub()
    {
        session(['oauth_origin' => url()->previous()]);
        return Socialite::driver('github')->redirect();
    }

    // Manejar la respuesta de GitHub
    public function handleGitHubCallback()
    {
        try {
            $githubUser = Socialite::driver('github')->stateless()->user();

            // Verificar si ya existe un usuario con el mismo email
            $user = User::where('email', $githubUser->getEmail())->first();
    
            if ($user) {
                // Actualizar el usuario existente
                $user->update([
                    'username' => $githubUser->getName(),
                    'OAuth' => 1,
                    'password' => bcrypt('default_password'),
                    'creado_el' => now(),
                ]);
            } else {
                // Verificar si el username ya está en uso
                $username = $githubUser->getName();
                if (User::where('username', $username)->exists()) {
                    $username = $username . '_' . uniqid(); // Generar un username único
                }
    
                // Crear un nuevo usuario
                $user = User::create([
                    'email' => $githubUser->getEmail(),
                    'username' => $username,
                    'OAuth' => 1,
                    'password' => bcrypt('default_password'),
                    'creado_el' => now(),
                ]);
            }
    
            Auth::login($user);
    
            return redirect('/myArticles');
        } catch (\Exception $e) {
            $origin = session('oauth_origin', '/login');
            return redirect($origin)->withErrors(['email' => 'Ya existe una cuenta con este correo electrónico.']);
        }
    }
}