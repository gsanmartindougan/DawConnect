@extends('layouts.app')
@section('content')
    <div class="card mx-1" style="background-color: rgb(254, 253, 237, 0.4); ">
        <div class="card-body justify-content-center">
            <div class="card card shadow-lg p-2 mb-5 bg-white rounded">
                <div class="p-2 text-center">
                    @if ($curso->user->id == auth()->user()->id)
                        <a href="{{ route('perfil.index') }}" class="link-dark link-underline-opacity-0">
                            <img src="{{ asset($curso->user->avatar()) }}" alt="{{ asset('images/avatar/default.png') }}"
                                style="width: 40px; height: 40px; border-radius: 50%;" class="py-0">
                            {{ $curso->user->name }}
                        </a>
                    @else
                        <a href="{{ route('perfil.show', $curso->user->id) }}" class="link-dark link-underline-opacity-0">
                            <img src="{{ asset($curso->user->avatar()) }}" alt="{{ asset('images/avatar/default.png') }}"
                                style="width: 40px; height: 40px; border-radius: 50%;" class="py-0">
                            {{ $curso->user->name }}
                        </a>
                    @endif
                </div>
                <div class="card-body">
                    <h2>{{ $curso->title }}</h2>
                    <hr>
                    <div class="table-responsive">{!! $curso->content !!}</div>
                </div>
                <div class="d-flex p-1">
                    <div class="col-3 text-start">
                        <div class="row">
                            <div class="d-flex">
                                <div>
                                    <form action="{{ route('pdf') }}" method="POST">
                                        @csrf
                                        @method('post')
                                        <button type="submit" class="btn btn-sm"><x-carbon-generate-pdf /></button>
                                        <input type="hidden" name="id" value="{{ $curso->id }}">
                                    </form>
                                </div>
                                <div>
                                    <form id="like_curso"><button class="btn btn-sm btn-outline-success p-0 m-0"
                                            type="submit"><x-antdesign-heart /></button><input type="hidden" name="id"
                                            id="id" value="{{ $curso->id }}"> {{ $curso->likes }}
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-9 text-end">
                        @if ($curso->user_id != auth()->user()->id)
                            <a class="h-6 w-6 text-red-600 text-warning" title="Reportar" style="cursor: pointer;"
                                onclick="reportarCurso({{ $curso->id }})">
                                <x-carbon-flag /></a>
                        @endif
                        @if ($curso->teacher_id == auth()->user()->id)
                            <a href="{{ route('cursos.edit', $curso->id) }}" class="h-6 w-6 text-red-600"
                                title="editar"><x-antdesign-edit-o /></a>
                            <a class="h-6 w-6 text-red-600 text-danger" data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal{{ $curso->id }}" title="borrar">
                                <x-antdesign-delete-o /></a>
                            @include('pages.cursos.modal.borrar')
                        @endif
                        <span>{{ (new DateTime($curso->created_at))->format('d-m-Y H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script>
        document.getElementById('like_curso').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.showLoading()
            let id = document.getElementById('id').value;
            console.log(id);

            axios.get('{{ route('cursos.like', $curso->id) }}')
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

        function reportarCurso(curso_id) {
            event.preventDefault();
            let formData = {
                id: curso_id,
            }
            //console.log(id);
            axios.post('{{ route('reportCurso') }}', formData)
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
                        text: 'Parece que ya has reportado este curso.',
                    });
                });
        }
    </script>
@endpush
