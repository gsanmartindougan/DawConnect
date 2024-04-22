@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Listado de Posts de Desarrollo Web Entorno Servidor</h1>
        <ul class="list-group">
            @forelse ($posts as $post)
                <li class="list-group-item">
                    <div class="d-flex justify-content-evenly align-items-center">
                        <div class="col-9">
                            <a href="{{ route('post.show', $post->id) }}"
                                class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                <span>{{ $post->title }}</span></a>
                        </div>
                        <div class="d-flex col-3 justify-content-end">
                            @if ($post->student_id == session('user')->id)
                                <a href="{{route('post.edit', $post->id)}}" class="h-6 w-6 text-red-600"><x-antdesign-edit-o /></a>
                                <a class="h-6 w-6 text-red-600 text-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal{{$post->id}}">
                                    <x-antdesign-delete-o /></a>
                                @include('pages.asignaturas.modal.borrar')
                            @endif
                        </div>
                    </div>
                </li>
            @empty
                <li class="list-group-item">No hay ninguna publicación disponible</li>
            @endforelse
        </ul>
    </div>

@endsection
