@extends('layouts.app')

@section('content')
    {{-- dd($post) --}}
    <div class="card mx-4" style="background-color: rgb(254, 253, 237, 0.4); ">
        <div class="card-body justify-content-center">
            <div class="card">
                <div class="card-header text-center">
                    <h6>{{ $post->title }}</h6>
                </div>
                <div class="card-body">
                    <p>{!! $post->content !!}</p>
                </div>
                <div class="card-footer text-end">
                    <span>{{ $post->created_at }}</span>
                    @if ($post->student_id == session('user')->id)
                        <a href="{{ route('post.edit', $post->id) }}" class="h-6 w-6 text-red-600"
                            title="editar"><x-antdesign-edit-o /></a>
                        <a class="h-6 w-6 text-red-600 text-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal{{ $post->id }}" title="borrar">
                            <x-antdesign-delete-o /></a>
                        @include('pages.asignaturas.modal.borrar')
                    @endif
                </div>
            </div>
            <hr>
            <div class="col text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#nuevoComentario"><x-bx-message-alt-add /> Nuevo</button>
            </div>
            @forelse ($comments as $comment)
                <div class="card mt-3">
                    <div class="card-header">
                        {{ $comment->user->name }}
                    </div>
                    <div class="card-body">
                        {!! $comment->content !!}
                    </div>
                    <div class="card-footer">
                        @if ($comment->user_id == session('user')->id)
                        <div class="text-end">
                            <span>{{ $comment->created_at }}</span>
                            <a data-bs-toggle="modal"
                                data-bs-target="#editComentario{{ $comment->id }}" class="h-6 w-6 text-red-600"
                                title="editar"><x-antdesign-edit-o /></a>
                            <a data-bs-toggle="modal"
                            data-bs-target="#delCom{{ $comment->id }}" class="h-6 w-6 text-red-600 text-danger" title="borrar">
                                <x-antdesign-delete-o /></a>
                        </div>
                            @include('pages.post.comentarios.edit')
                            @include('pages.post.comentarios.borrar')
                        @endif
                    </div>
                </div>
            @empty
                <p>No hay comentarios aún.</p>
            @endforelse
        </div>
        @include('pages.post.comentarios.create')
    </div>
@endsection

@push('custom-scripts')
    <script>
        let mensaje = localStorage.getItem('mensaje');

        if (mensaje) {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: mensaje,
            });
            localStorage.removeItem('mensaje');
        }
    </script>
@endpush
