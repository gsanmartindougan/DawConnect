<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Comment;

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
        $post->student_id = $request->user_id;
        $post->subject_id = $request->asignatura;
        $post->title = $request->titulo;
        $post->content = $request->content;
        $post->save();
        $comments = Comment::where('post_id', $post->id)->get();
        return view('pages.post.show', compact('post', 'comments'));
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
        //dd($id);
        $post = Posts::find($id);
        $post->title = $request->titulo;
        $post->content = $request->content;
        $post->save();

        $comments = Comment::where('post_id', $id)->get();
        return view('pages.post.show', compact('post', 'comments'));
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $post = Posts::find($id);
        $post->delete();
        return back()->with('success', '¡El post ha sido borrado correctamente!');
    }
}
