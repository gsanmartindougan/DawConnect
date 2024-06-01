<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Comment;
use App\Models\User;
use App\Models\Course;
use App\Models\Aviso;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function buscar(Request $request)
    {
        //Esto lo hice con ayuda de chatGPT
        $query = $request->busqueda;
        $query = htmlentities($query, ENT_QUOTES, 'UTF-8');
        // Busca en publicaciones
        $posts = Posts::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->get();

        // Busca en comentarios
        $comments = Comment::where('content', 'LIKE', "%{$query}%")
            ->get();

        // Busca en cursos
        $courses = Course::where('content', 'LIKE', "%{$query}%")
            ->get();

        // Busca en avisos
        $avisos = Aviso::where('title', 'LIKE', "%{$query}%")
            ->orWhere('content', 'LIKE', "%{$query}%")
            ->get();

        // Busca en usuarios
        $users = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->get();

        // Combina los resultados en una colección
        $results = collect([
            'posts' => $posts,
            'comments' => $comments,
            'courses' => $courses,
            'avisos' => $avisos,
            'users' => $users,
        ]);

        return view('pages.search.show', compact('results', 'query'));
    }
}
