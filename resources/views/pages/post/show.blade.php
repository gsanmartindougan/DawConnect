@extends('layouts.app')

@section('content')
    {{-- dd($post) --}}
    <div class="card mx-1" style="background-color: rgb(254, 253, 237, 0.4); ">
        <div class="card-body justify-content-center">
            <div class="card shadow-lg p-2 mb-5 bg-white rounded">
                <div class="p-3 text-center">
                    @if ($post->user->id == auth()->user()->id)
                        <a href="{{ route('perfil.index') }}" class="link-dark link-underline-opacity-0">
                            <img src="{{ asset($post->user->avatar()) }}" alt="{{ asset('images/avatar/default.png') }}"
                                style="width: 40px; height: 40px; border-radius: 50%;" class="py-0">
                            {{ $post->user->name }}
                        </a>
                    @else
                        <a href="{{ route('perfil.show', $post->user->id) }}" class="link-dark link-underline-opacity-0">
                            <img src="{{ asset($post->user->avatar()) }}" alt="{{ asset('images/avatar/default.png') }}"
                                style="width: 40px; height: 40px; border-radius: 50%;" class="py-0">
                            {{ $post->user->name }}
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    <h2>{{ $post->title }}</h2>
                    <hr>
                    <div class="table-responsive">{!! $post->content !!}</div>
                </div>
                <div class="d-flex  p-1">
                    <div class="col-3 text-start">
                        <span>
                            <form id="like_post"><button class="btn btn-sm btn-outline-success p-0 m-0"
                                    type="submit"><x-bx-heart /></button><input type="hidden" name="id"
                                    id="id" value="{{ $post->id }}"> {{ $post->likes }}</form>
                        </span>
                    </div>
                    <div class="col-9 text-end">
                        @if ($post->user_id != auth()->user()->id)
                            <a class="h-6 w-6 text-red-600 text-warning" title="Reportar" style="cursor: pointer;"
                                onclick="reportarPost({{ $post->id }})">
                                <x-carbon-flag /></a>
                        @endif
                        @if ($post->student_id == auth()->user()->id)
                            <a href="{{ route('post.edit', $post->id) }}" class="h-6 w-6 text-red-600" title="editar"
                                style="cursor: pointer;"><x-antdesign-edit-o /></a>
                            <a class="h-6 w-6 text-red-600 text-danger" data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal{{ $post->id }}" title="borrar"
                                style="cursor: pointer;">
                                <x-antdesign-delete-o /></a>
                            @include('pages.asignaturas.modal.borrar')
                        @endif
                        <span>{{ (new DateTime($post->created_at))->format('d-m-Y H:i') }}</span>
                    </div>
                </div>
            </div>
            <hr>
            <div class="col text-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#nuevoComentario"><x-bx-message-alt-add /> Nuevo</button>
            </div>
            @forelse ($comments as $comment)
                <div class="card mt-3 shadow-lg bg-white rounded">
                    <div class="card-header py-0">
                        @if ($comment->user->id == auth()->user()->id)
                            <a href="{{ route('perfil.index') }}" class="link-dark link-underline-opacity-0">
                                <img src="{{ asset($comment->user->avatar()) }}"
                                    alt="{{ asset('images/avatar/default.png') }}"
                                    style="width: 20px; height: 20px; border-radius: 50%;" class="py-0">
                                {{ $comment->user->name }}
                            </a>
                        @else
                            <a href="{{ route('perfil.show', $comment->user->id) }}"
                                class="link-dark link-underline-opacity-0">
                                <img src="{{ asset($comment->user->avatar()) }}"
                                    alt="{{ asset('images/avatar/default.png') }}"
                                    style="width: 20px; height: 20px; border-radius: 50%;" class="py-0">
                                {{ $comment->user->name }}
                            </a>
                        @endif
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            {!! $comment->content !!}
                        </div>
                    </div>
                    <div class="card-footer py-0">
                        <div class="text-end">
                            @if ($comment->user_id != auth()->user()->id)
                                <a class="h-6 w-6 text-red-600 text-warning" title="Reportar"
                                    onclick="reportarComentario({{ $comment->id }})" style="cursor: pointer;">
                                    <x-carbon-flag /></a>
                            @endif
                            @if ($comment->user_id == auth()->user()->id)
                                <a data-bs-toggle="modal" data-bs-target="#editComentario{{ $comment->id }}"
                                    class="h-6 w-6 text-red-600" title="editar"
                                    style="cursor: pointer;"><x-antdesign-edit-o /></a>
                                <a data-bs-toggle="modal" data-bs-target="#delCom{{ $comment->id }}"
                                    class="h-6 w-6 text-red-600 text-danger" title="borrar" style="cursor: pointer;">
                                    <x-antdesign-delete-o /></a>
                                @include('pages.post.comentarios.edit')
                                @include('pages.post.comentarios.borrar')
                            @endif
                            <span>{{ (new DateTime($comment->created_at))->format('d-m-Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            @empty
                <p>No hay comentarios aún.</p>
            @endforelse
            <p class="mt-2 text-center">
                {{ $comments->links() }}
            </p>
        </div>
        @include('pages.post.comentarios.create')
    </div>
@endsection

@push('custom-scripts')
    <script>
        document.getElementById('like_post').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.showLoading()
            let id = document.getElementById('id').value;
            //console.log(id);

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
                        text: 'Hubo un error. Por favor, inténtalo de nuevo más tarde.',
                    });
                });
        });

        function reportarComentario(com_id) {
            event.preventDefault();
            let formData = {
                id: com_id,
            }
            //console.log(id);
            axios.post('{{ route('reportCom') }}', formData)
                .then(function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: response.data.mensaje,
                    });
                })
                .catch(function(error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Parece que ya has reportado este comentario.',
                    });
                });
        }

        function reportarPost(post_id) {
            event.preventDefault();
            let formData = {
                id: post_id,
            }
            //console.log(id);
            axios.post('{{ route('repotPost') }}', formData)
                .then(function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: response.data.mensaje,
                    });
                })
                .catch(function(error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Parece que ya has reportado esta publicación.',
                    });
                });
        }
    </script>
@endpush
