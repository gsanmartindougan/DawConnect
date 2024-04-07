@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ $post->title }}</div>

                <div class="card-body">
                    <p>{{ $post->content }}</p>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Comentarios</div>

                <div class="card-body">
                    <ul class="list-group">
                        @forelse ($comments as $comment)
                            <li class="list-group-item">{{ $comment->content }}</li>
                        @empty
                            <p>No hay comentarios aún.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Modales --}}

@endsection

