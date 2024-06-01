<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Rules\NoEmptyHtml;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ComentarioNotificacion;
use DOMDocument;

class CommentController extends Controller
{
    use Notifiable;
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
        //https://github.com/mohsenkarimi-mk/Summernote-Text-Editor-CRUD-Image-Upload-in-Laravel/blob/main/app/Http/Controllers/PostController.php
        $request->validate([
            'content' => ['required', new NoEmptyHtml],
        ], [
            'content.required' => '¡Escribe algo!',
        ]);
        $contenido = $request->input('content');
        //dd($contenido);
        $documento = new DOMDocument();
        $documento->loadHTML('<meta charset="utf8">' . $contenido, 9);
        //dd($documento);
        $imagenes = $documento->getElementsByTagName('img');

        foreach ($imagenes as $key => $imagen) {
            $data = base64_decode(explode(',', explode(';', $imagen->getAttribute('src'))[1])[1]);
            $image_name = "/upload/" . 'cm_'. auth()->user()->id .'_'.time().'.png';
            file_put_contents(public_path() . $image_name, $data);
            $imagen->removeAttribute('src');
            $imagen->setAttribute('src', $image_name);
        }
        $contenido = $documento->saveHTML();

        $comentario = new Comment();
        $comentario->user_id = $request->input('user_id');
        $comentario->post_id = $request->input('post_id');
        $comentario->content = $contenido;
        $comentario->save();

        $post = Posts::find($request->input('post_id'));
        $user =$post->user;
        //dd($user);
        $user->notify(new ComentarioNotificacion($post));
        return response()->json([
            'success' => true,
            'mensaje' => '¡El comentario se ha publicado correctamente!'
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
        //https://github.com/mohsenkarimi-mk/Summernote-Text-Editor-CRUD-Image-Upload-in-Laravel/blob/main/app/Http/Controllers/PostController.php
        $comentario = Comment::find($id);

        $contenido = $request->content;
        $documento = new DOMDocument();
        $documento->loadHTML('<meta charset="utf8">' . $contenido, 9);
        //dd($documento);
        $imagenes = $documento->getElementsByTagName('img');

        foreach ($imagenes as $key => $imagen) {
            if (strpos($imagen->getAttribute('src'),'data:image/') ===0) {
                $data = base64_decode(explode(',',explode(';',$imagen->getAttribute('src'))[1])[1]);
                $image_name = "/upload/" . time(). $key.'.png';
                file_put_contents(public_path().$image_name,$data);

                $imagen->removeAttribute('src');
                $imagen->setAttribute('src',$image_name);
            }
        }
        $contenido = $documento->saveHTML();
/*         $comentario = Comment::find($id);*/
        $comentario->content = $contenido;
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
        //https://github.com/mohsenkarimi-mk/Summernote-Text-Editor-CRUD-Image-Upload-in-Laravel/blob/main/app/Http/Controllers/PostController.php
        $comentario = Comment::find($id);
        $dom= new DOMDocument();
        $dom->loadHTML($comentario->content,9);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {

            $src = $img->getAttribute('src');
            $path = Str::of($src)->after('/');


            if (File::exists($path)) {
                File::delete($path);
            }
        }
        $comentario->delete();
        return response()->json([
            'success' => true,
            'mensaje' => '¡El comentario se ha borrado correctamente!',
        ]);
    }
}
