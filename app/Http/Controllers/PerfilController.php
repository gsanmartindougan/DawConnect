<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Models\Posts;
use App\Models\Course;
use App\Models\User;
use App\Models\Aviso;
class PerfilController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(auth()->user()->student){
            $posts = Posts::where('student_id', auth()->user()->id)->get();
            return view('pages.profile.index', compact('posts'));
        }
        if(auth()->user()->teacher){
            $cursos = Course::where('teacher_id', auth()->user()->id)->get();
            return view('pages.profile.index', compact('cursos'));
        }
        if(auth()->user()->mod){
            $avisos = Aviso::where('mod_id', auth()->user()->id)->get();
            return view('pages.profile.index', compact('avisos'));
        }

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
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $user = User::find($id);
        if($user->student){
            $posts = Posts::where('student_id', $id)->get();
            return view('pages.profile.show', compact('posts', 'user'));
        }
        if($user->teacher){
            $cursos = Course::where('teacher_id', $id)->get();
            return view('pages.profile.show', compact('cursos', 'user'));
        }
        if($user->mod){
            $avisos = Aviso::where('mod_id', $id)->get();
            return view('pages.profile.show', compact('avisos', 'user'));
        }

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
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        //
    }
}
