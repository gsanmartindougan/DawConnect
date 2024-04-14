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
    // Aquí defines tus rutas que requieren autenticación

    Route::resource('/home', App\Http\Controllers\HomeController::class);
    Route::resource('/post', App\Http\Controllers\PostController::class);
    Route::resource('/asignatura', App\Http\Controllers\SubjectController::class);
    Route::resource('/perfil', App\Http\Controllers\PerfilController::class);

});

