@extends('layouts.app')

@section('content')
    {{-- dd($post) --}}
    <div class="card mx-4" style="background-color: rgb(254, 253, 237, 0.4); ">
        <div class="card-body justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h6>{{ $post->title }}</h6>
                </div>
                <div class="card-body">
                    <p>{!! $post->content !!}</p>
                </div>
                <div class="card-footer text-end">
                    <span>{{ $post->created_at }}</span>
                    @if ($post->student_id == session('user')->id)
                        <a href="{{ route('post.edit', $post->id) }}" class="h-6 w-6 text-red-600"><x-antdesign-edit-o /></a>
                        <a class="h-6 w-6 text-red-600 text-danger" data-bs-toggle="modal"
                            data-bs-target="#confirmDeleteModal{{ $post->id }}">
                            <x-antdesign-delete-o /></a>
                        @include('pages.asignaturas.modal.borrar')
                    @endif
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">Comentarios</div>
                <div class="card-body">
                    <ul class="list-group">
                        @forelse ($comments as $comment)
                            <li class="list-group-item">{!! $comment->content !!}</li>
                        @empty
                            <p>No hay comentarios aún.</p>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    const urlParams = new URLSearchParams(window.location.search);
    const mensaje = urlParams.get('mensaje');

    if (mensaje) {
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: mensaje,
        });
    }
</script>

@endpush
