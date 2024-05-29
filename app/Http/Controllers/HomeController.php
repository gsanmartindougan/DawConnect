<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Aviso;
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
        $user = auth()->user();
        if ($user) {
            session()->put('user', $user);
            $asignaturas = Subject::all();
            foreach ($asignaturas as $asignatura) {
                $asignatura->recent_posts = $asignatura->recentPosts();
                $asignatura->recent_course = $asignatura->recentCourse();
            }
            $avisos = Aviso::all();
        } else {
            $asignaturas = Subject::all();
            foreach ($asignaturas as $asignatura) {
                $asignatura->recent_course = $asignatura->recentCourse();
                $asignatura->recent_posts = $asignatura->recentPosts();
            }
        }

        // Guardar las asignaturas en la sesión
        session()->put('asignaturas', $asignaturas);

        // Retornar la vista con las asignaturas
        return view('pages.home.home', compact('asignaturas', 'avisos'));
    }

}
