{{-- Modal borrar curso --}}
<div class="modal fade" id="confirmDeleteModal{{ $curso->id }}" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel{{ $curso->id }}">Confirmar Borrado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                ¿Estás seguro de que deseas borrar este curso?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" id="deletePostBtn{{$curso->id}}" class="btn btn-danger">Borrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@push('custom-scripts')
    <script>
        document.getElementById('deletePostBtn{{ $curso->id }}').addEventListener('click', function() {
            Swal.showLoading()
            axios.delete('{{ route('cursos.destroy', $curso->id) }}')
                .then(function(response) {
                    //console.log(response.data);
                    let mensaje = response.data.mensaje;
                    localStorage.setItem('mensaje', mensaje);
                    window.location.replace('{{ url('/') }}');
                })
                .catch(function(error) {
                    console.error(error);
                });
        });
    </script>
@endpush
