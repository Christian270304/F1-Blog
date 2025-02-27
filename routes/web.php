<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', function () {
    return view('anonymous');
})->name('anonymous');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/signup',function () { 
    return view('signup');
})->name('signup');

Route::get('/admin', function () {
    return view('admin');
})->name('admin');

Route::get('/profile', function () {
    return view('profile');
})->name('profile');

Route::get('/articles', function () {
    return view('articles');
})->name('articles');

Route::get('/newArticle', function () {
    return view('newArticle');
})->name('newArticle');

Route::get('/home', function () {
    return view('home');
})->name('home');

Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/signup', [RegisterController::class, 'register']);