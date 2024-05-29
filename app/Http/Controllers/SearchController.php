<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Comment;
use App\Models\User;
use App\Models\Course;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function buscar(Request $request)
    {
        $query = $request->busqueda;

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

        /*         // Busca en avisos
                $notices = Notice::where('title', 'LIKE', "%{$query}%")
                    ->orWhere('description', 'LIKE', "%{$query}%")
                    ->get();
         */
        // Busca en usuarios
        $users = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->get();

        // Combina los resultados en una colección
        $results = collect([
            'posts' => $posts,
            'comments' => $comments,
            'courses' => $courses,
            /* 'notices' => $notices, */
            'users' => $users,
        ]);

        return view('pages.search.show', compact('results', 'query'));
    }
}
