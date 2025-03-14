<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function showArticles()
    {
        return view('articles');
    }

    public function showMyArticles()
    {
        return view('myArticles');
    }
}
