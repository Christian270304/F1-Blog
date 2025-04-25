<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\QRController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use App\Http\Controllers\Auth\SocialiteController;

// Mostrar el formulario para solicitar el restablecimiento de contraseña
Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

// Enviar el correo de restablecimiento de contraseña
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Mostrar el formulario para restablecer la contraseña
Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');

// Procesar el restablecimiento de contraseña
Route::post('/password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

// Confirmar la contraseña antes de realizar acciones sensibles
Route::get('/password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('/password/confirm', [ConfirmPasswordController::class, 'confirm']);



Route::get('/auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])->name('google.callback');

Route::get('/auth/github/redirect', [SocialiteController::class, 'redirectToGitHub'])->name('github.redirect');
Route::get('/auth/github/callback', [SocialiteController::class, 'handleGitHubCallback'])->name('github.callback');

Route::get('/', [ArticleController::class, 'showAnonymous'])->name('anonymous');

Route::middleware('guest')->group(function () {

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

    Route::get('/signup', [RegisterController::class, 'showRegisterForm'])->name('signup');

    Route::post('/login', [LoginController::class, 'login']);

    Route::post('/signup', [RegisterController::class, 'register']);

});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin', [UserController::class, 'getUsersAdmin'])->name('admin');

    Route::post('/delete-user', [AdminController::class, 'deleteUser'])->name('deleteUser');

});

Route::middleware('auth')->group(function () {

    Route::get('/articles', [ArticleController::class, 'showArticles'])->name('articles');

    Route::get('/myArticles', [ArticleController::class, 'showMyArticles'])->name('myArticles');

    

    Route::get('/profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('/newArticle', [ArticleController::class, 'showNewArticle'])->name('newArticle');

    // Route::get('/home', function () {
    //     return view('home');
    // })->name('home');

    Route::get('/readQR', [QRController::class, 'showQRForm'])->name('readQR');

    Route::get('/edit/{id}', [ArticleController::class, 'editArticle'])->name('editArticle');

    Route::get('/article/{id}', [ArticleController::class, 'getArticle'])->name('getArticle');

    Route::get('/generate-qr', [QRController::class, 'generate'])->name('generate.qr');

    Route::get('/userProfile', [UserController::class, 'showUserProfile'])->name('userProfile');

    Route::post('/read-qr', [QRController::class, 'readQR'])->name('read.qr');

    Route::post('/generate-tokens', [TokenController::class, 'generateTokens'])->name('generate.tokens');

    Route::post('/newArticle', [ArticleController::class, 'newArticle']);

    Route::post('/updateProfile', [UserController::class, 'updateProfile'])->name('updateProfile');

    Route::post('/updatePassword', [UserController::class, 'updatePassword'])->name('updatePassword');

    Route::put('updateArticle/{id}', [ArticleController::class, 'updateArticle'])->name('updateArticle');

    Route::delete('delete/{id}', [ArticleController::class, 'deleteArticle'])->name('deleteArticle');
});
?>

