<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Post;
use App\Models\User;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Obtener el usuario autenticado
        $user = auth()->user();

        // Verificar si el usuario está autenticado
        if ($user) {
            // Guardar el usuario en la sesión
            session()->put('user', $user);

            // Obtener todas las asignaturas del usuario
            $asignaturas = Subject::all();
            foreach ($asignaturas as $asignatura) {
                $asignatura->recent_posts = $asignatura->recentPosts();
            }
        } else {
            // Si el usuario no está autenticado, obtener todas las asignaturas
            $asignaturas = Subject::all();
            foreach ($asignaturas as $asignatura) {
                $asignatura->recent_posts = $asignatura->recentPosts();
            }
        }

        // Guardar las asignaturas en la sesión
        session()->put('asignaturas', $asignaturas);

        // Retornar la vista con las asignaturas
        return view('pages.home.home', compact('asignaturas'));
    }

}
