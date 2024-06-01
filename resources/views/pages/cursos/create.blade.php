@extends('layouts.app')

@section('content')
    <div class="card mx-1" style="background-color: rgba(254, 253, 237, 0.4);">
        <div class="card-body justify-content-md-center">
            <div class="col-md-12">
                <div class="text-center">
                    <h3 class="card-title">Nuevo Curso</h3>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form id="postForm">
                            <label for="asignatura" class="fs-5">Asignatura</label>
                            <select name="asignatura" id="asignatura" class="form-select form-select-lg mb-3" required>
                                <option value="">Elige una asignatura</option>
                                @php
                                    $asignaturas = session('asignaturas');
                                @endphp
                                @foreach ($asignaturas as $asignatura)
                                    <option value="{{ $asignatura->id }}">{{ $asignatura->name }}</option>
                                @endforeach
                            </select>
                            <label for="titulo" class="fs-5">Título</label>
                            <input type="text" id="titulo" name="titulo" class="form-control mb-2" required>
                            <textarea id="" class="summernote summernote_create" name="content"></textarea>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-2">Publicar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script>
        document.getElementById('postForm').addEventListener('submit', function(event) {
            event.preventDefault();
            if ($('.summernote_create').summernote('isEmpty')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops!',
                    text: '¡Escribe algo!',
                });
            }else{
                Swal.showLoading()
                let formData = new FormData(this);
                axios.post('{{ route('cursos.store') }}', formData)
                    .then(function(response) {
                        //console.log(response.data.postUrl)
                        let cursoUrl = response.data.cursoUrl;
                        let mensaje = response.data.mensaje;
                        localStorage.setItem('mensaje', mensaje);
                        window.location.replace(cursoUrl);
                    })
                    .catch(function(error) {
                        console.error(error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops!',
                            text: error.response.data.message,
                        });
                    });
            }
        });
    </script>
@endpush
