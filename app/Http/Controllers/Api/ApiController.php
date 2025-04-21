<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;

class ApiController extends Controller
{
    public function getArticles()
    {
        $articles = Article::all();
        return response()->json($articles, 200);
    }

    public function getUsers()
    {
        $users = User::select('id', 'username', 'email', 'bio', 'creado_el', 'role')->get();
        return response()->json($users, 200);
    }

    public function getArticleById($id)
    {
        if (!is_numeric($id)) {
            return response()->json(['message' => 'Invalid ID format'], 400);
        }

        $article = Article::find($id);
        if ($article) {
            return response()->json($article, 200);
        } else {
            return response()->json(['message' => 'Article not found'], 404);
        }
    }

    public function getUserById($id)
    {
        if (!is_numeric($id)) {
            return response()->json(['message' => 'Invalid ID format'], 400);
        }
        
        $user = User::find($id);
        if ($user) {
            return response()->json($user, 200);
        } else {
            return response()->json(['message' => 'User not found'], 404);
        }
    }
}
