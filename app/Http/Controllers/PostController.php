<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Comment;
use Illuminate\Support\Facades\URL;

class PostController extends Controller
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
        return view('pages.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $post = new Posts();
        $post->student_id = $request->input('user_id');
        $post->subject_id = $request->input('asignatura');
        $post->title = $request->input('titulo');
        $post->content = $request->input('content');
        $post->save();

        $postUrl = URL::route('post.show', ['post'=>$post->id]);
        $comments = Comment::where('post_id', $post->id)->get();

        return response()->json([
            'success' => true,
            'post' => $post,
            'postUrl' => $postUrl,
            'mensaje' => '¡La publicación se ha creado correctament!',
            'comments' => $comments,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $post = Posts::find($id);
        $comments = Comment::where('post_id', $id)->get();
        return view('pages.post.show', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $post = Posts::find($id);
        return view('pages.post.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        //dd($request->titulo);
        $post = Posts::find($id);
        $post->title = $request->titulo;
        $post->content = $request->content;
        $post->save();

        $postUrl = URL::route('post.show', ['post'=>$post->id]);
        $comments = Comment::where('post_id', $post->id)->get();

        return response()->json([
            'success' => true,
            'post' => $post,
            'postUrl' => $postUrl,
            'mensaje' => '¡La publicación se ha modificado correctament!',
            'comments' => $comments,
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $post = Posts::find($id);
        $post->delete();
        return response()->json([
            'success' => true,
            'mensaje' => '¡La publicación se ha borrado correctament!',
        ]);
    }
}
