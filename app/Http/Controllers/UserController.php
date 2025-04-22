<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Article;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'bio' => 'nullable|string|max:255',
        ]);

        $user = $request->user();

        if ($user->username !== $request->username) {
            $request->validate([
            'username' => 'unique:users,username',
            ]);
            $user->username = $request->username;
        }

        if ($user->email !== $request->email) {
            $request->validate([
            'email' => 'unique:users,email',
            ]);
            $user->email = $request->email;
        }

        $user->bio = $request->bio;
        $user->save();

        return back()->with('status', 'Perfil actualizada correctamente');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|string',
        ]);

        $this->validateCurrentPassword($request);

        $user = $request->user();
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('status', 'Contraseña actualizada correctamente');
    }

    public function getUsersAdmin()
    {
        // Seleccionar todos los usuarios menos los que tienen el rol de admin
        $users = User::where('role', '!=', 'admin')->get();
        return view('admin', compact('users'));
    }

    public function showUserProfile(Request $request)
    {
        //Obtener el username de la url
        $username = $request->query('username');
 
        // Obtener el usuario por su username
        $user = User::where('username', $username)->first();
        // Verificar si el usuario existe
        if (!$user) {
            return back()->with('error', 'El usuario no existe.');
        }
        // Obtener los artículos del usuario
        $articles = Article::where('user_id', $user->id)->get();
        // Devolver la vista con el usuario y sus artículos
        return view('userProfile', compact('user', 'articles'));
    }
    
    private function validateCurrentPassword(Request $request)
    {
        if (!Hash::check($request->current_password, $request->user()->password)) {
            return back()->withErrors(['current_password' => 'La contrasenya proporcionada no coincideix amb la teva contrasenya actual.'])->with('modal', 'passwordModal');
        }
    }
}
