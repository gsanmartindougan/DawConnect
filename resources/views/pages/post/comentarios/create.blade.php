<div class="modal fade" id="nuevoComentario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nuevo comentario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="postForm">
                    <textarea id="" name="content" class="summernote" required></textarea>
                    <input type="hidden" name="user_id" value="{{ session('user')->id }}">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-2">Publicar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@push('custom-scripts')
    <script>
        document.getElementById('postForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let formData = new FormData(this);

            axios.post('{{ route('comentario.store') }}', formData)
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
