@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('post.edit', $post) }}
    <div class="card" style="background-color: rgb(254, 253, 237, 0.4); ">
        <div class="card-body justify-content-md-center">
            <div class="col-md-12">
                <div class="text-center">
                    <h3 class="card-title">Editar Publicación</h3>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form id="editForm">
                            <label for="titulo" class="fs-5">Título</label>
                            <input type="text" id="titulo" name="titulo" class="form-control mb-2"
                                value="{{ $post->title }}">
                            <textarea id="content" class="summernote" name="content">{{ $post->content }}</textarea>
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
        document.getElementById('editForm').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.showLoading()
            let formData = ({
                titulo: document.getElementById('titulo').value,
                content: document.getElementById('content').value
            });
            axios.patch('{{ route('post.update', $post->id) }}', formData)
                .then(function(response) {
                    let postUrl = response.data.postUrl;
                    let mensaje = response.data.mensaje;
                    localStorage.setItem('mensaje', mensaje);
                    window.location.replace(postUrl);
                })
                .catch(function(error) {
                    console.error(response.data.postUrl);
                });
        });
    </script>
@endpush
