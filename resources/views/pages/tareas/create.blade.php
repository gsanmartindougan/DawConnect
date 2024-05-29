<div class="modal fade" id="create_tarea" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-fullscreen-sm-down">
        <div class="modal-content">
            <div class="modal-header  text-center">
                <h3 class="modal-title">Nueva Tarea</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body col-md-12">
                <form id="tareaForm">
                    <label for="titulo" class="fs-5"></label>
                    <input type="text" id="titulo" name="titulo" class="form-control mb-2" required>
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <div class="text-center">
                        <a class="btn btn-secondary mt-2" data-bs-dismiss="modal" aria-label="Close">Cerrar</a>
                        <button type="submit" class="btn btn-primary mt-2">Crear</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('custom-scripts')
    <script>
        document.getElementById('tareaForm').addEventListener('submit', function(event) {
            event.preventDefault();
            //Swal.showLoading()
            let formData = new FormData(this);
            //console.log(formData)
            axios.post('{{ route('tareas.store') }}', formData)
                .then(function(response) {
                    //console.log(response.data.postUrl)
                    //let postUrl = response.data.postUrl;
                    Swal.fire({
                        icon: 'success',
                        title: '¡Éxito!',
                        text: response.data.mensaje,
                    });
                })
                .catch(function(error) {
                    console.error(error);
                    console.error(response.data.postUrl);
                });
        });
    </script>
@endpush
