<div class="card mx-5" style="background-color: rgb(254, 253, 237, 0.4); ">
    <div class="card-body">
        <h1 class="mb-4"> {{$posts[0]?->asignatura?->name}} </h1>
        <ul class="list-group">
            @forelse ($posts as $post)
                <li class="list-group-item">
                    <div class="d-flex justify-content-evenly align-items-center">
                        <div class="col-9">
                            <p class="py-0 my-0">
                                <a href="{{ route('post.show', $post->id) }}"
                                    class="py-0 my-0 link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                    <span>{{ $post->title }}</span>
                                </a>
                            </p>
                            <small
                                class="fw-lighter py-0 my-0 text-info">{{ (new DateTime($post->created_at))->format('d/m/Y H:i') }}</small>
                        </div>
                        <div class="d-flex col-3 justify-content-end">
                            @if ($post->student_id == auth()->user()->id)
                                <a href="{{ route('post.edit', $post->id) }}"
                                    class="h-6 w-6 text-red-600"><x-antdesign-edit-o /></a>
                                <a class="h-6 w-6 text-red-600 text-danger" data-bs-toggle="modal"
                                    data-bs-target="#confirmDeleteModal{{ $post->id }}">
                                    <x-antdesign-delete-o /></a>
                                @include('pages.asignaturas.modal.borrar')
                            @endif
                        </div>
                    </div>
                </li>
            @empty
                <li class="list-group-item">No hay ninguna publicación disponible</li>
            @endforelse
        </ul>
        <div id="pagination-container" class="d-flex justify-content-center">
            {!! $posts->links() !!}
        </div>
    </div>
</div>
