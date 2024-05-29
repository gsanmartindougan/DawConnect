<div class="modal fade" id="create_post" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header  text-center">
                <h3 class="modal-title">Nueva Publicación</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body col-md-12">
                <form id="postForm">
                    <label for="asignatura" class="fs-5">Asignatura</label>
                    <select name="asignatura" id="asignatura" class="form-select form-select-lg mb-3" required>
                        @php
                            $asignaturas = session('asignaturas');
                        @endphp
                        @foreach ($asignaturas as $asignatura)
                            <option value="{{ $asignatura->id }}">{{ $asignatura->name }}</option>
                        @endforeach
                    </select>
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

    @push('custom-scripts')
        <script>
            document.getElementById('postForm').addEventListener('submit', function(event) {
                event.preventDefault();
                Swal.showLoading()
                let formData = new FormData(this);
                //console.log(formData)
                axios.post('{{ route('post.store') }}', formData)
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
