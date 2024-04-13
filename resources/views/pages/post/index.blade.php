@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Listado de Posts</h1>
    <ul class="list-group">
        @forelse ($posts as $post)
        <li class="list-group-item">
            <div class="d-flex justify-content-between align-items-center">
                <span>{{ $post->title }}</span>
                <a href="{{ route('post.show', $post->id) }}" class="btn btn-primary">Ver más</a>
            </div>
        </li>
        @empty
        <li class="list-group-item">No hay ninguna publicación disponible</li>
        @endforelse
    </ul>
</div>
@endsection
