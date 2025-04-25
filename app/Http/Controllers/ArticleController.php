<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    public function showAnonymous(Request $request)
    {
        $perPage = $request->input('perPage', 5);
        $articles = Article::select('id','titol', 'cos', 'image', 'user_id')->paginate($perPage);
        $articles->toArray();
        return view('anonymous', compact('articles'));
    }

    public function showArticles(Request $request)
    {
        $perPage = $request->input('perPage', 5);
        $articles = Article::select('id','titol', 'cos', 'image', 'user_id')->paginate($perPage);
        // Transformar los datos de los artículos
        $articles->getCollection()->transform(function ($article) {
            return [
                'id' => $article->id,
                'titol' => $article->titol,
                'cos' => $article->cos,
                'image' => $article->image,
                'user' => [
                    'username' => $article->user->username,
                ],
            ];
        });
    
        return view('articles', compact('articles'));
    }

    public function showMyArticles(Request $request)
    {
        $order = $request->get('order', 'ASC');

        $userId = Auth::id();
        $perPage = $request->input('perPage', 5);
        $articles = Article::where('user_id', $userId)->orderBy('titol', $order)->paginate($perPage);
        return view('myArticles' , compact('articles', 'order'));
    }

    public function showNewArticle()
    {
        return view('newArticle');
    }

    public function newArticle(Request $request)
    {
        $this->validator($request->all())->validate();

        $article = $this->create($request);

        if ($article) {
            return redirect()->route('myArticles');
        }

    }

    protected function validator (array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'body' => ['required', 'string'],
            'image' => ['required', 'image'],
        ]);
    }

    protected function create(Request $request)
    {
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/articles', 'public');
            if (!$imagePath) {
                throw new \Exception('Error al subir la imagen');
            }
        } else {
            $imagePath = null;
        }

        return Article::create([
            'titol' => $request->input('title'),
            'cos' => $request->input('body'),
            'image' => $imagePath,
            'creado_el' => now(),
            'modificado_el' => now(),
            'user_id' => Auth::id(),
        ]);
    }

    public function editArticle($id)
    {
        $article = Article::find($id);

        // Verificar si el usuario autenticado es el propietario del artículo
        if (!$article || $article->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'No tienes permiso para editar este artículo.');
        }

        return view('newArticle', compact('article'));
    }

    public function updateArticle(Request $request, $id)
    {
        $article = Article::find($id);


        // Verificar si el usuario autenticado es el propietario del artículo
        if ( $article->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'No tienes permiso para editar este artículo.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
            'image' => 'nullable|image', 
        ]);

        $article->titol = $request->input('title');
        $article->cos = $request->input('body');
        $article->modificado_el = now();

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads/articles', 'public');
            $article->image = $imagePath;
        } elseif ($request->input('existing_image')) {
            $article->image = $request->input('existing_image');
        }

        $article->save();

        return redirect()->route('myArticles');
    }

    public function getArticle($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return redirect()->back()->with('error', 'Artículo no encontrado.');
        }

        return response()->json([
            'titol' => $article->titol,
            'cos' => $article->cos,
            'image' => $article->image,
        ]);
    }

    public function deleteArticle($id)
    {
        $article = Article::find($id);

        // Verificar si el usuario autenticado es el propietario del artículo
        if (!$article || $article->user_id !== Auth::id()) {
            return redirect()->back()->with('error', 'No tienes permiso para eliminar este artículo.');
        }

        $article->delete();

        return response()->json(['success' => 'Artículo eliminado correctamente.']);
    }

}
