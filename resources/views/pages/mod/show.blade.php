@extends('layouts.app')

@section('content')
    <div class="col-12 card">
        <div class="col-12 card-body">
            <div class="table-responsive">
                <table id="mis_publicaciones_table" class="table table-striped col-12 w-100 p-0 data_table">
                    <thead>
                        <tr>
                            <th style="width: 25%">Tipo</th>
                            <th style="width: 50%">Título</th>
                            <th class="text-end" style="width: 25%">Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($usuario->student)
                            @foreach ($usuario->reportPost as $post)
                                <tr>
                                    <td>Publicación</td>
                                    <td><a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                            href="{{ route('post.show', $post->post->id) }}">{{ $post->post->title }}</a>
                                    </td>
                                    <td class="text-end">{{ $post->post->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                            @endforeach
                        @endif
                        @if ($usuario->teacher)
                            @foreach ($usuario->reportCurso as $curso)
                                <tr>
                                    <td>Curso</td>
                                    <td><a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                            href="{{ route('cursos.show', $curso->curso->id) }}">{{ $curso->curso->title }}</a>
                                    </td>
                                    <td class="text-end"> {{ $curso->curso->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                            @endforeach
                        @endif
                        @foreach ($usuario->reportComentario as $comentario)
                            <tr>
                                <td>Comentario</td>
                                <td><a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                        href="{{ route('post.show', $comentario->comment->post->id) }}">{!! strip_tags($comentario->comment->content) !!}</a>
                                </td>
                                <td class="text-end">{{ $comentario->comment->created_at->format('d-m-Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

