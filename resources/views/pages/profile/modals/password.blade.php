<div class="modal fade" id="cambioPass" tabindex="-1" aria-labelledby="cambioContrasena" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content p-4">
            <form action="{{ route('cambioPassword') }}" method="POST" id="cambio">
                @csrf
                <div class="mb-3">
                    <label for="oldPassword" class="form-label">Antigua contraseña</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label">Nueva contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation_1" name="password_confirmation_1"
                        required>
                </div>
                <div class="mb-3">
                    <label for="confirmNewPassword" class="form-label">Repetir contraseña</label>
                    <input type="password" class="form-control" id="password_confirmation_2"
                        name="password_confirmation_2" required>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
        </div>
    </div>
</div>
