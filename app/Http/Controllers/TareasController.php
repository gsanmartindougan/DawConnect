<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kanban\TaskKanban;
use App\Models\Tarea;
class TareasController extends Controller
{
    public function index()
    {
        $pendientes = Tarea::where('user_id', auth()->user()->id)
        ->where('state_id', 1)->orderBy('updated_at', 'desc')
        ->get();
        $proceso = Tarea::where('user_id', auth()->user()->id)
        ->where('state_id', 2)->orderBy('updated_at', 'desc')
        ->get();
        $completado = Tarea::where('user_id', auth()->user()->id)
        ->where('state_id', 3)->orderBy('updated_at', 'desc')
        ->get();
        return view('pages.tareas.index', compact('pendientes', 'proceso', 'completado'));
    }
    public function create()
    {
        return view('pages.post.create');
    }
    public function store(Request $request)
    {
        $tarea = new Tarea();
        $tarea->user_id = $request->input('user_id');
        $tarea->title = $request->input('titulo');
        $tarea->state_id = 1;
        $tarea->save();

        //$postUrl = URL::route('post.show', ['post' => $post->id]);

        return response()->json([
            'success' => true,
            'mensaje' => '¡La tarea se ha creado correctamente!',
        ]);
    }
    public function update(Request $request, $id)
    {
        //dd($request->id);
        $tarea = Tarea::find($request->id);
        $tarea->title = $request->titulo;
        $tarea->save();
        return response()->json([
            'success' => true,
            'mensaje' => '¡Tarea modificada correctamente!',
        ]);
    }
    public function estado(Request $request)
    {
        $tarea = Tarea::find($request->id);
        $tarea->state_id += 1;
        $tarea->save();
        return response()->json([
            'success' => true,
            'mensaje' => '¡Tarea movida correctamente!',
        ]);
    }
    public function destroy(Request $request, $id)
    {
        $tarea = Tarea::find($request->id);
        //dd($request);
        $tarea->delete();
        return response()->json([
            'success' => true,
            'mensaje' => '¡Tarea borrada correctamente!',
        ]);
    }
    public function borrado(Request $request)
    {
        $tarea = Tarea::find($request->id);
        //dd($request);
        $tarea->delete();
        return response()->json([
            'success' => true,
            'mensaje' => '¡Tarea borrada correctamente!',
        ]);
    }
    public function show($id)
    {
        return view('pages.tareas.show');
    }
}
