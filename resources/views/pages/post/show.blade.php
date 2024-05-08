@extends('layouts.app')

@section('content')
    {{-- dd($post) --}}
    <div class="card mx-4" style="background-color: rgb(254, 253, 237, 0.4); ">
        <div class="card-body justify-content-center">
            <div class="card">
                <div class="card-header bg-primary text-center">
                    <h6>{{ $post->title }}</h6>
                </div>
                <div class="card-body">
                    <p>{!! $post->content !!}</p>
                </div>
                <div class="d-flex card-footer bg-primary py-0">
                    <div class="col-3 text-start">
                        <span>
                            <form id="like_post"><button class="btn btn-sm btn-outline-success p-0 m-0"
                                    type="submit"><x-antdesign-heart /></button><input type="hidden" name="id"
                                    id="id" value="{{ $post->id }}"> {{ $post->likes }}</form>
                        </span>
                    </div>
                    <div class="col-9 text-end">
                        <span>{{ (new DateTime($post->created_at))->format('d-m-Y H:i') }}</span>
                        @if ($post->student_id == auth()->user()->id)
                            <a href="{{ route('post.edit', $post->id) }}" class="h-6 w-6 text-red-600"
                                title="editar"><x-antdesign-edit-o /></a>
                            <a class="h-6 w-6 text-red-600 text-danger" data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal{{ $post->id }}" title="borrar">
                                <x-antdesign-delete-o /></a>
                            @include('pages.asignaturas.modal.borrar')
                        @endif
                    </div>
                </div>
            </div>
            <hr>
            <div class="col text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#nuevoComentario"><x-bx-message-alt-add /> Nuevo</button>
            </div>
            @forelse ($comments as $comment)
                <div class="card mt-3">
                    <div class="card-header bg-secondary py-0">
                        @if ($comment->user->id == auth()->user()->id)
                            <a href="{{ route('perfil.index') }}" class="link-dark link-underline-opacity-0">
                                <img src="{{ asset($comment->user->avatar) }}"
                                    alt="{{ asset('images/avatar/default.png') }}" style="width: 20px; height: 20px;"
                                    class="py-0"> {{ $comment->user->name }}
                            </a>
                        @else
                            <a href="{{ route('perfil.show', $comment->user->id) }}"
                                class="link-dark link-underline-opacity-0">
                                <img src="{{ asset($comment->user->avatar) }}"
                                    alt="{{ asset('images/avatar/default.png') }}" style="width: 20px; height: 20px;"
                                    class="py-0"> {{ $comment->user->name }}
                            </a>
                        @endif
                    </div>
                    <div class="card-body">
                        {!! $comment->content !!}
                    </div>
                    <div class="card-footer bg-secondary py-0">
                        <div class="text-end">
                            <span>{{ (new DateTime($comment->created_at))->format('d-m-Y H:i') }}</span>
                            @if ($comment->user_id == auth()->user()->id)
                                <a data-bs-toggle="modal" data-bs-target="#editComentario{{ $comment->id }}"
                                    class="h-6 w-6 text-red-600" title="editar"><x-antdesign-edit-o /></a>
                                <a data-bs-toggle="modal" data-bs-target="#delCom{{ $comment->id }}"
                                    class="h-6 w-6 text-red-600 text-danger" title="borrar">
                                    <x-antdesign-delete-o /></a>
                                @include('pages.post.comentarios.edit')
                                @include('pages.post.comentarios.borrar')
                            @endif
                        </div>
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
            localStorage.removeItem('mensaje_error');
            localStorage.removeItem('mensaje');
        }
        let mensaje_error = localStorage.getItem('mensaje_error');

        if (mensaje_error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: mensaje_error,
            });
            localStorage.removeItem('mensaje');
            localStorage.removeItem('mensaje_error');
        }

        document.getElementById('like_post').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.showLoading()
            let id = document.getElementById('id').value;
            console.log(id);

            axios.get('{{ route('post.like', $post->id) }}')
                .then(function(response) {
                    let mensaje = response.data.mensaje;
                    let mensaje_error = response.data.mensaje_error;
                    if (mensaje) {
                        localStorage.setItem('mensaje', mensaje);
                    }
                    if (mensaje_error) {
                        localStorage.setItem('mensaje_error', mensaje_error);
                    }
                    window.location.reload();
                })
                .catch(function(error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Hubo un error al dar like a la publicación. Por favor, inténtalo de nuevo más tarde.',
                    });
                });
        });
    </script>
@endpush
