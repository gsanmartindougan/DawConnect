<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use App\Models\Posts;
use App\Models\User;
class PerfilController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $posts = Posts::where('student_id', auth()->user()->id)->get();
        if (request()->ajax()) {
            return view('pages.profile.tabs.publicaciones', compact('posts'));
        }
        return view('pages.profile.index', compact('posts'));
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
        $posts = Posts::where('student_id', $user->id)->get();
        if (request()->ajax()) {
            return view('pages.profile.tabs.publicaciones', compact('posts'));
        }
        return view('pages.profile.show', compact('posts', 'user'));

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
