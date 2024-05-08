@extends('layouts.app')
@section('content')
    <div class="card mx-4" style="background-color: rgb(254, 253, 237, 0.4); ">
        <div class="card-body justify-content-center">
            <div class="card">
                <div class="card-header bg-danger text-center">
                    {{--dd($curso)--}}
                    <h6>{{ $curso->title }}</h6>
                </div>
                <div class="card-body">
                    <p>{!! $curso->content !!}</p>
                </div>
                <div class="d-flex card-footer bg-danger py-0">
                    <div class="col-3 text-start">
                        <span>
                            <form id="like_curso"><button class="btn btn-sm btn-outline-success p-0 m-0"
                                    type="submit"><x-antdesign-heart /></button><input type="hidden" name="id"
                                    id="id" value="{{ $curso->id }}"> {{ $curso->likes }}</form>
                        </span>
                    </div>
                    <div class="col-9 text-end">
                        <span>{{ (new DateTime($curso->created_at))->format('d-m-Y H:i') }}</span>
                        @if ($curso->teacher_id == auth()->user()->id)
                            <a href="{{ route('cursos.edit', $curso->id) }}" class="h-6 w-6 text-red-600"
                                title="editar"><x-antdesign-edit-o /></a>
                            <a class="h-6 w-6 text-red-600 text-warning" data-bs-toggle="modal"
                                data-bs-target="#confirmDeleteModal{{ $curso->id }}" title="borrar">
                                <x-antdesign-delete-o /></a>
                            {{-- @include('pages.asignaturas.modal.borrar') --}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
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

        document.getElementById('like_curso').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.showLoading()
            let id = document.getElementById('id').value;
            console.log(id);

            axios.get('{{ route('post.like', $curso->id) }}')
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
