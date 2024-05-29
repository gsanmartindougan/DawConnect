@extends('layouts.app')

@section('content')
    <div class="card mx-1" style="background-color: rgb(254, 253, 237, 0.4); ">
        <div class="card-body justify-content-md-center">
            <div class="col-md-12">
                <div class="text-center">
                    {{-- dd(auth()->user()) --}}
                    <h3 class="card-title">Editar Curso</h3>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form id="editCurso">
                            <label for="titulo" class="fs-5">Título</label>
                            <input type="text" id="titulo" name="titulo" class="form-control mb-2"
                                value="{{ $curso->title }}">
                            <textarea id="content" class="summernote" name="content">{{ $curso->content }}</textarea>
                            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary mt-2">Guardar</button>
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
        document.getElementById('editCurso').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.showLoading()
            let formData = ({
                titulo: document.getElementById('titulo').value,
                content: document.getElementById('content').value
            });
            console.log(formData)
            axios.patch('{{ route('cursos.update', $curso->id) }}', formData)
                .then(function(response) {
                    let cursoUrl = response.data.cursoUrl;
                    let mensaje = response.data.mensaje;
                    localStorage.setItem('mensaje', mensaje);
                    window.location.replace(cursoUrl);
                })
                .catch(function(error) {
                    console.error(response.data.postUrl);
                });
        });
    </script>
@endpush
