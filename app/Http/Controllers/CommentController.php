<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $comentario = new Comment();
        $comentario->user_id = $request->input('user_id');
        $comentario->post_id = $request->input('post_id');
        $comentario->content = $request->input('content');
        $comentario->save();

        return response()->json([
            'success' => true,
            'mensaje' => '¡El comentario se ha publicado correctament!'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        //dd($request->input('content'));
        $comentario = Comment::find($id);
        $comentario->content = $request->content;
        $comentario->save();

        return response()->json([
            'success' => true,
            'mensaje' => '¡El comentario se ha modificado correctamente!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $comentario = Comment::find($id);
        $comentario->delete();
        return response()->json([
            'success' => true,
            'mensaje' => '¡El comentario se ha borrado correctamente!',
        ]);
    }
}
