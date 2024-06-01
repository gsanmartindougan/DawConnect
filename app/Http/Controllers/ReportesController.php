<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Posts;
use App\Models\Comment;
use App\Models\Course;
use App\Models\ReportComment;
use App\Models\ReportPost;
use App\Models\ReportCourse;

class ReportesController extends Controller
{
    public function index()
    {
        $usuarios = User::with('reportPost', 'reportCurso', 'reportComentario')->get();
        foreach($usuarios as $usuario){
            $usuario->total += $usuario->reportPost->count();
            $usuario->total += $usuario->reportCurso->count();
            $usuario->total += $usuario->reportComentario->count();
        }
        return view('pages.mod.index', compact('usuarios'));
    }

    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('pages.mod.show', compact('usuario'));
    }

    public function repotPost(Request $request)
    {
        $post = Posts::findOrFail($request->id);
        $reporte = new ReportPost();
        $reporte->user_id = $post->user->id;
        $reporte->post_id = $request->id;
        $reporte->save();
        return response()->json([
            'success' => true,
            'mensaje' => '¡Publicación reportada correctamente!',
        ]);
    }

    public function reportCom(Request $request)
    {
        $comentario = Comment::findOrFail($request->id);
        $reporte = new ReportComment();
        $reporte->user_id = $comentario->user->id;
        $reporte->comment_id = $request->id;
        $reporte->save();
        return response()->json([
            'success' => true,
            'mensaje' => '¡Comentario reportado correctamente!',
        ]);
    }

    public function reportCurso(Request $request)
    {
        $curso = Course::findOrFail($request->id);
        $reporte = new ReportCourse();
        $reporte->user_id = $curso->user->id;
        $reporte->course_id = $request->id;
        $reporte->save();
        return response()->json([
            'success' => true,
            'mensaje' => '¡Curso reportado correctamente!',
        ]);
    }
}
