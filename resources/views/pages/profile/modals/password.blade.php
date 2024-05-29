<div class="modal fade" id="cambioPass" tabindex="-1" aria-labelledby="cambioContrasena" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-4">
            <div class="modal-header">
                <h5 class="modal-title">Cambio de contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('cambioPassword') }}" method="POST" id="cambio">
                    @csrf
                    <div class="mb-3">
                        <label for="oldPassword" class="form-label">Antigua contraseña</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="newPassword" class="form-label">Nueva contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation_1"
                            name="password_confirmation_1" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirmNewPassword" class="form-label">Repetir contraseña</label>
                        <input type="password" class="form-control" id="password_confirmation_2"
                            name="password_confirmation_2" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('custom-scripts')
    <script>
        document.getElementById('cambio').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.showLoading()
            let formData = ({
                antigua: document.getElementById('password').value,
                nueva1: document.getElementById('password_confirmation_1').value,
                nueva2: document.getElementById('password_confirmation_2').value,
            });
            axios.post('{{ route('cambioPassword') }}', formData)
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
                        text: error.response.data.message,
                    });
                });
        });
    </script>
@endpush
