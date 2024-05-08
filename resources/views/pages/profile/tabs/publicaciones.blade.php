<div class="card">
    <div class="card-body">
        <ul class="list-group">
            @forelse ($posts as $post)
                <li class="list-group-item">
                    <div class="d-flex justify-content-evenly align-items-center">
                        <div class="col-9">
                            <p class="py-0 my-0">
                                <a href="{{ route('post.show', $post->id) }}"
                                    class="py-0 my-0 link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">
                                    <span>{{ Str::limit($post->title, 30) }}</span>
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
                <li class="d-flex justify-content-evenly align-items-center">Aún no has hecho ninguna publicación</li>
            @endforelse
        </ul>
        <div id="pagination-container" class="d-flex justify-content-center">
            {!! $posts->links() !!}
        </div>
    </div>
</div>
