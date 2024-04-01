@extends('layouts.app')
{{--  dd(session('asignaturas')) --}}
@section('content')
    <div class="container mt-6">
        <!-- Tabs navs -->
        <div class="d-flex justify-content-center">
            <ul class="nav nav-underline">
                <li class="nav-item">
                    <h5>
                        <a class="nav-link active" aria-current="page" data-bs-toggle="tab" role="tab"
                            aria-controls="simple-tabpanel-0" aria-selected="true"
                            href="#publicaciones_recientes">Publicaciones
                            recientes</a>
                    </h5>
                </li>
                <li class="nav-item">
                    <h5>
                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-1"
                            aria-selected="false" href="#cursos_recientes">Cursos recientes</a>
                    </h5>
                </li>
                <li class="nav-item">
                    <h5>
                        <a class="nav-link" data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-2"
                            aria-selected="false" href="#avisos">Avisos</a>
                    </h5>
                </li>
            </ul>
        </div>
        <!-- Tabs navs -->
    </div>

    {{-- Tabs --}}
    <div class="tab-content pt-4 col-sm-10 mx-auto" role="tablist">
        {{-- Tab publicaciones recientes --}}
        <div class="tab-pane active" id="publicaciones_recientes" role="tabpanel" aria-labelledby="simple-tab-0">
            <div class="row justify-content-center">
                @forelse ($asignaturas as $asignatura)
                    <div class="p-2 col-sm-6" role="tabpanel">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title text-center"><a href="{{route('asignatura.show', htmlspecialchars($asignatura->id))}}"
                                        class="link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover">{{ $asignatura->name }}</a>
                                </h5>
                                @foreach ($asignatura->recent_posts as $post)
                                    <li>
                                        <a href="{{route('post.show', htmlspecialchars($post->id))}}"
                                            class="link-body-emphasis link-offset-2 link-underline-opacity-0 link-underline-opacity-75-hover">{{ $post->title }}</a>
                                    </li>
                                @endforeach
                                <p class="card-text"></p>
                            </div>
                        </div>
                    </div>
                @empty
                <p>No hay posts disponidbles</p>
                @endforelse
            </div>
        </div>

        {{-- Tab cursos recientes --}}
        <div class="tab-pane" id="cursos_recientes" role="tabpanel" aria-labelledby="simple-tab-1">
            <div class="container">
                cursos recientes
            </div>
        </div>

        {{--Tab avisos--}}
        <div class="tab-pane" id="avisos" role="tabpanel" aria-labelledby="simple-tab-2">
            <div class="container">
                avisos
            </div>
        </div>
    </div>
@endsection
