<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Course;
use Illuminate\Support\Facades\URL;
class CursosController extends Controller
{
    //
    public function show($id)
    {
        $curso = Course::find($id);
        return view('pages.cursos.show', compact('curso'));
    }
    public function create()
    {
        return view('pages.cursos.create');
    }
    public function store(Request $request)
    {
        $curso = new Course();
        $curso->teacher_id = $request->input('user_id');
        $curso->subject_id = $request->input('asignatura');
        $curso->title = $request->input('titulo');
        $curso->content = $request->input('content');
        $curso->save();

        $cursoUrl = URL::route('cursos.show', ['curso' => $curso->id]);

        return response()->json([
            'success' => true,
            'curso' => $curso,
            'cursoUrl' => $cursoUrl,
            'mensaje' => '¡Curso creado correctamente!'
        ]);
    }
    public function edit($id)
    {
        $curso = Course::find($id);
        return view('pages.cursos.edit', compact('curso'));
    }
    public function update(Request $request, $id)
    {
        $curso = Course::find($id);
        $curso->title = $request->titulo;
        $curso->content = $request->content;
        //dd($curso);
        $curso->save();

        $cursoUrl = URL::route('cursos.show', ['curso' => $curso->id]);

        return response()->json([
            'success' => true,
            'curso' => $curso,
            'cursoUrl' => $cursoUrl,
            'mensaje' => '¡El curso se ha modificado correctamente!'
        ]);
    }
}
