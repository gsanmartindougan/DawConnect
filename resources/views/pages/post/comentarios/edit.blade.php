<div class="modal fade text-start" id="editComentario{{ $comment->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar comentario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editComentarioForm{{ $comment->id }}">
                    @csrf
                    @method('patch')
                    <textarea id="content{{ $comment->id }}" name="content" class="summernote" required>{{ $comment->content }}</textarea>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-2">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('custom-scripts')
    <script>
        document.getElementById('editComentarioForm{{ $comment->id }}').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.showLoading()
            let formData = ({
                content: document.getElementById('content{{ $comment->id }}').value
            });
            axios.patch('{{ route('comentario.update', $comment->id) }}', formData)
                .then(function(response) {
                    let mensaje = response.data.mensaje;
                    localStorage.setItem('mensaje', mensaje);
                    window.location.reload();
                })
                .catch(function(error) {
                    console.error(error);
                });
        });
    </script>
@endpush
