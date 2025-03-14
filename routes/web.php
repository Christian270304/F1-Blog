<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('anonymous');
})->name('anonymous');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

Route::get('/signup', [RegisterController::class, 'showRegisterForm'])->name('signup');

Route::get('/articles', [ArticleController::class, 'showArticles'])->name('articles');

Route::get('/myArticles', [ArticleController::class, 'showMyArticles'])->name('myArticles');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/newArticle', function () {
    return view('newArticle');
})->name('newArticle');

Route::get('/home', function () {
    return view('home');
})->name('home');

// Route::get('/readQR', [QRController::class, 'showQRForm'])->name('readQR');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/signup', [RegisterController::class, 'register']);

?>