<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Course;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Rules\NoEmptyHtml;
use Barryvdh\DomPDF\Facade\Pdf;
use DOMDocument;

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
        if (!auth()->user()->teacher) {
            abort(404, 'No tienes acceso');
        }
        return view('pages.cursos.create');
    }
    public function store(Request $request)
    {
        //https://github.com/mohsenkarimi-mk/Summernote-Text-Editor-CRUD-Image-Upload-in-Laravel/blob/main/app/Http/Controllers/PostController.php
        if (!auth()->user()->teacher) {
            abort(404, 'No tienes acceso');
        }

        $request->validate([
            'content' => ['required', new NoEmptyHtml],
        ], [
            'content.required' => '¡Escribe algo!',
        ]);

        $contenido = $request->input('content');
        $documento = new DOMDocument();
        $documento->loadHTML('<meta charset="utf8">' . $contenido, 9);
        //dd($documento);
        $imagenes = $documento->getElementsByTagName('img');

        foreach ($imagenes as $key => $imagen) {
            $data = base64_decode(explode(',', explode(';', $imagen->getAttribute('src'))[1])[1]);
            $image_name = "/upload/" . 'c_' . auth()->user()->id . '_'.time(). '.png';
            file_put_contents(public_path() . $image_name, $data);
            $imagen->removeAttribute('src');
            $imagen->setAttribute('src', $image_name);
        }
        $contenido = $documento->saveHTML();

        $curso = new Course();
        $curso->teacher_id = $request->input('user_id');
        $curso->subject_id = $request->input('asignatura');
        $curso->title = $request->input('titulo');
        $curso->content = $contenido;
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
        if (!auth()->user()->teacher) {
            abort(404, 'No tienes acceso');
        }
        $curso = Course::find($id);
        return view('pages.cursos.edit', compact('curso'));
    }
    public function update(Request $request, $id)
    {
        //https://github.com/mohsenkarimi-mk/Summernote-Text-Editor-CRUD-Image-Upload-in-Laravel/blob/main/app/Http/Controllers/PostController.php
        if (!auth()->user()->teacher) {
            abort(404, 'No tienes acceso');
        }
        $curso = Course::find($id);
        $contenido = $request->content;
        $documento = new DOMDocument();
        $documento->loadHTML('<meta charset="utf8">' . $contenido, 9);
        //dd($documento);
        $imagenes = $documento->getElementsByTagName('img');

        foreach ($imagenes as $key => $imagen) {
            if (strpos($imagen->getAttribute('src'),'data:image/') ===0) {
                $data = base64_decode(explode(',',explode(';',$imagen->getAttribute('src'))[1])[1]);
                $image_name = "/upload/" . 'c_' . auth()->user()->id .'_'. time(). '.png';
                file_put_contents(public_path().$image_name,$data);

                $imagen->removeAttribute('src');
                $imagen->setAttribute('src',$image_name);
            }
        }
        $contenido = $documento->saveHTML();

        $curso->title = $request->titulo;
        $curso->content = $contenido;
        $curso->save();
        $cursoUrl = URL::route('cursos.show', ['curso' => $curso->id]);

        return response()->json([
            'success' => true,
            'curso' => $curso,
            'cursoUrl' => $cursoUrl,
            'mensaje' => '¡El curso se ha modificado correctamente!'
        ]);
    }

    public function like($id)
    {
        $curso = Course::find($id);
        $user = auth()->user();
        if ($user->likes_curso->contains($curso)) {
            return response()->json([
                'success' => false,
                'mensaje_error' => '¡Ya has añadido este curso a favoritos correctamente!'
            ]);
        } else {
            $curso->likes_count();
            $curso->save();
            $user->likes_curso()->attach($curso->id);
            return response()->json([
                'success' => true,
                'post' => $curso,
                'mensaje' => '¡Añadido a favoritos correctamente!'
            ]);
        }
    }

    public function destroy($id)
    {
        //https://github.com/mohsenkarimi-mk/Summernote-Text-Editor-CRUD-Image-Upload-in-Laravel/blob/main/app/Http/Controllers/PostController.php
        if (!auth()->user()->teacher) {
            abort(404, 'No tienes acceso');
        }
        $curso = Course::find($id);
        $dom= new DOMDocument();
        $dom->loadHTML($curso->content,9);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $key => $img) {

            $src = $img->getAttribute('src');
            $path = Str::of($src)->after('/');


            if (File::exists($path)) {
                File::delete($path);
            }
        }

        $curso->delete();
        return response()->json([
            'success' => true,
            'mensaje' => '¡El curso se ha borrado correctamente!',
        ]);
    }

    public function pdf(Request $request)
    {
        //dd($request);
        $curso = Course::find($request->id);
        $data = [
            'titulo' => $curso->title,
            'contenido' => $curso->content
        ];
        $pdf = Pdf::loadView('pdf.curso', $data);
        return $pdf->download($curso->title.'.pdf');
    }
}
