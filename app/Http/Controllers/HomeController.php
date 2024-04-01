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
        $asignaturas = Subject::all();
        foreach ($asignaturas as $asignatura) {
            $asignatura->recent_posts = $asignatura->recentPosts();
        }

        session()->put('asignaturas', $asignaturas);
        return view('pages.home.home', compact('asignaturas'));
    }
}
