<div class="modal fade" id="cambioAvatar" tabindex="-1" aria-labelledby="cambioAvatar" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h5 class="modal-title">Cambio de avatar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cambioAvatar') }}" method="POST" id="cambioAvatarForm">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="file" class="form-control" id="avatar" name="avatar">
                    </div>
                    <button type="submit" class="btn btn-primary">Cambiar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        document.getElementById('cambioAvatarForm').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.showLoading()
            let formData = ({
                avatar: document.getElementById('avatar').files[0],
            });
            console.log(formData)
            axios.post('{{ route('cambioAvatar') }}', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
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
                    //console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: error.response.data.message,
                    });
                });
        });
    </script>
@endpush
