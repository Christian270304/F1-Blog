<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;

class AdminController extends Controller
{
    public function deleteUser(Request $request)
    {
        $userId = $request->input('user_id');
        $deleteArticles = $request->input('delete_articles') === 'true';

        // Buscar el usuario
        $user = User::find($userId);

        if (!$user) {
            return redirect()->back()->with('error', 'Usuario no encontrado.');
        }

        // Eliminar los artículos asociados si se seleccionó la opción
        if ($deleteArticles) {
            Article::where('user_id', $userId)->delete();
        }

        // Eliminar el usuario
        $user->delete();

        return redirect()->back()->with('success', 'Usuario eliminado correctamente.');
    }
}
