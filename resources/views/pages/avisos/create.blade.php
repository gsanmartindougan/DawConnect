@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('avisos.create') }}
    <div class="card" style="background-color: rgba(254, 253, 237, 0.4);">
        <div class="card-body justify-content-md-center">
            <div class="col-md-12">
                <div class="text-center">
                    <h3 class="card-title">Nuevo Aviso</h3>
                </div>
                <div class="card">
                    <div class="card-body">
                        <form id="postForm">
                            <label for="titulo" class="fs-5">Título</label>
                            <input type="text" id="titulo" name="titulo" class="form-control mb-2" required>
                            <textarea id="" class="summernote" name="content"></textarea>
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
            Swal.showLoading()
            let formData = new FormData(this);
            //console.log(formData)
            axios.post('{{ route('avisos.store') }}', formData)
                .then(function(response) {
                    //console.log(response.data.postUrl)
                    let postUrl = response.data.postUrl;
                    let mensaje = response.data.mensaje;
                    localStorage.setItem('mensaje', mensaje);
                    window.location.replace(postUrl);
                })
                .catch(function(error) {
                    console.error(error);
                    console.error(response.data.postUrl);
                });
        });
    </script>
@endpush
