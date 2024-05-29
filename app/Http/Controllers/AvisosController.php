<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use App\Models\Aviso;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Comment;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use App\Notifications\AvisoNotificacion;
use Illuminate\Support\Str;
use DOMDocument;

class AvisosController extends Controller
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
        return view('pages.avisos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //

        $contenido = $request->input('content');
        $documento = new DOMDocument();
        $documento->loadHTML('<meta charset="utf8">' . $contenido, 9);
        //dd($documento);
        $imagenes = $documento->getElementsByTagName('img');

        foreach ($imagenes as $key => $imagen) {
            $data = base64_decode(explode(',', explode(';', $imagen->getAttribute('src'))[1])[1]);
            $image_name = "/upload/" . 'a_'. auth()->user()->id . '_'.time().'.png';
            file_put_contents(public_path() . $image_name, $data);
            $imagen->removeAttribute('src');
            $imagen->setAttribute('src', $image_name);
        }
        $contenido = $documento->saveHTML();

        $aviso = new Aviso();
        $aviso->mod_id = $request->input('user_id');
        $aviso->title = $request->input('titulo');
        $aviso->content = $contenido;
        $aviso->save();
        $users = User::all();
        //dd($user);
        foreach($users as $user){
            $user->notify(new AvisoNotificacion($aviso));
        }
        $avisoUrl = URL::route('avisos.show', ['aviso' => $aviso->id]);

        return response()->json([
            'success' => true,
            'post' => $aviso,
            'postUrl' => $avisoUrl,
            'mensaje' => '¡El aviso se ha creado correctamente!',
        ]);
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $aviso = Aviso::with('user')->find($id);
        return view('pages.avisos.show', compact('aviso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $aviso = Aviso::find($id);
        return view('pages.avisos.edit', compact('aviso'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $aviso = Aviso::find($id);

        $contenido = $request->content;
        $documento = new DOMDocument();
        $documento->loadHTML('<meta charset="utf8">' . $contenido, 9);
        //dd($documento);
        $imagenes = $documento->getElementsByTagName('img');

        foreach ($imagenes as $key => $imagen) {
            if (strpos($imagen->getAttribute('src'),'data:image/') ===0) {
                $data = base64_decode(explode(',',explode(';',$imagen->getAttribute('src'))[1])[1]);
                $image_name = "/upload/" . 'a_'. auth()->user()->id .'_'.time().'.png';
                file_put_contents(public_path().$image_name,$data);

                $imagen->removeAttribute('src');
                $imagen->setAttribute('src',$image_name);
            }
        }
        $contenido = $documento->saveHTML();

        $aviso->title = $request->titulo;
        $aviso->content = $contenido;
        $aviso->save();


        $postUrl = URL::route('avisos.show', ['aviso' => $aviso->id]);

        return response()->json([
            'success' => true,
            'post' => $aviso,
            'postUrl' => $postUrl,
            'mensaje' => '¡El aviso se ha modificado correctamente!',
        ]);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $aviso = Aviso::find($id);

        $dom= new DOMDocument();
        $dom->loadHTML($aviso->content,9);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {

            $src = $img->getAttribute('src');
            $path = Str::of($src)->after('/');


            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $aviso->delete();
        return response()->json([
            'success' => true,
            'mensaje' => '¡El aviso se ha borrado correctamente!',
        ]);
    }
}
