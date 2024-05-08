<div class="row justify-content-center">
    @forelse ($asignaturas as $asignatura)
        <div class="p-1 col-sm-4" role="tabpanel">
            <div class="card shadow p-3 bg-body rounded">
                <div class="card-body">
                    <h5 class="card-title text-center"><a
                            href="{{ route('asignatura.show', $asignatura->id) }}"
                            class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">{{ $asignatura->name }}</a>
                    </h5>
                    <ul class="list-group list-group-flush">
                        @foreach ($asignatura->recent_posts as $post)
                            <li class="list-group-item">
                                <a href="{{ route('post.show', $post->id) }}"
                                    class="link-body-emphasis link-offset-2 link-underline-opacity-0 link-underline-opacity-75-hover">{{ Str::limit($post->title, 40) }}</a>
                                <small class="text-info float-end">{{ (new DateTime($post->created_at))->format('d/m/Y H:i') }}</small>
                            </li>
                        @endforeach
                    </ul>

                    <p class="card-text"></p>
                </div>
            </div>
        </div>
    @empty
        <p>No hay posts disponidbles</p>
    @endforelse
</div>
