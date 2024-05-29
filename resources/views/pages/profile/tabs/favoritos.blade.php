<div class="col-12 card">
    <div class="col-12 card-body">
        <div class="d-flex justify-content-center">
            <ul class="nav nav-underline">
                <li class="nav-item">
                    <h5>
                        <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover active"
                            aria-current="page" data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-0"
                            aria-selected="true" href="#publicaciones_favoritas">Publicaciones</a>
                    </h5>
                </li>
                <li class="nav-item">
                    <h5>
                        <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                            data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-1" aria-selected="false"
                            href="#cursos_favoritos">Cursos</a>
                    </h5>
                </li>
            </ul>
        </div>
        <div class="tab-content" role="tablist">
            {{-- Tab publicaciones --}}
            <div class="tab-pane active" id="publicaciones_favoritas" role="tabpanel" aria-labelledby="simple-tab-0">
                <div class="row justify-content-center">
                    <div class="table-responsive">
                        <table id="publicaciones_favoritas_table" class="table table-striped col-12 w-100 data_table">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (auth()->user()->post_like as $post)
                                    <tr>
                                        <td><a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                                href="{{ route('post.show', $post->post->id) }}">{{ $post->post->title }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            {{-- Tab cursos --}}
            <div class="tab-pane" id="cursos_favoritos" role="tabpanel" aria-labelledby="simple-tab-0">
                <div class="row justify-content-center">
                    <div class="table-responsive">
                        <table id="cursos_favoritos_table" class="table table-striped col-12 w-100 data_table">
                            <thead>
                                <tr>
                                    <th>Título</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (auth()->user()->course_like as $curso)
                                    <tr>
                                        <td><a class="link-dark link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                                                href="{{ route('cursos.show', $curso->curso->id) }}">{{ $curso->curso->title }}</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
