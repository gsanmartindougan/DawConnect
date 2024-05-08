<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/home');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {
    Route::resource('/home', App\Http\Controllers\HomeController::class);
    Route::resource('/post', App\Http\Controllers\PostController::class);
    Route::resource('/cursos', App\Http\Controllers\CursosController::class);
    Route::get('/posts/search', [ App\Http\Controllers\PostController::class, 'search'])->name('post.search');
    Route::get('/posts/like/{id}', [ App\Http\Controllers\PostController::class, 'like'])->name('post.like');
    Route::resource('/asignatura', App\Http\Controllers\SubjectController::class);
    Route::resource('/perfil', App\Http\Controllers\PerfilController::class);
    Route::resource('/comentario', App\Http\Controllers\CommentController::class);
    Route::resource('/usuario', App\Http\Controllers\UserController::class);
    Route::post('/password', [App\Http\Controllers\UserController::class, 'password'])->name('cambioPassword');
});

