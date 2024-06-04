@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('buscar', $query) }}
<div class="card mx-0" style="background-color: rgba(254, 253, 237, 0.4);">
    <div class="card-body justify-content-md-center mx-0">
        <div class="container">
                <h2 class="text-center">Resultados de búsqueda para: "{{ $query }}"</h2>
                <!-- Tabs navs -->
                <div class="d-flex justify-content-center">
                    <ul class="nav nav-underline">
                        <li class="nav-item">
                            <h5>
                                <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover active"
                                    aria-current="page" data-bs-toggle="tab" role="tab"
                                    aria-controls="simple-tabpanel-0" aria-selected="true"
                                    href="#publicaciones_tab">Publicaciones</a>
                            </h5>
                        </li>
                        <li class="nav-item">
                            <h5>
                                <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                    data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-1"
                                    aria-selected="false" href="#cursos_tab">Cursos</a>
                            </h5>
                        </li>
                        <li class="nav-item">
                            <h5>
                                <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                    data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-1"
                                    aria-selected="false" href="#avisos_tab">Avisos</a>
                            </h5>
                        </li>
                        <li class="nav-item">
                            <h5>
                                <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                    data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-1"
                                    aria-selected="false" href="#comentarios_tab">Comentarios</a>
                            </h5>
                        </li>
                        <li class="nav-item">
                            <h5>
                                <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                    data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-2"
                                    aria-selected="false" href="#usuarios_tab">Usuarios</a>
                            </h5>
                        </li>
                    </ul>
                </div>
                <!-- Tabs navs -->
            </div>
            <div class="card-body">
                {{-- Tabs --}}
                <div class="tab-content" role="tablist">
                    {{-- Tab Publicaciones --}}
                    <div class="tab-pane active " id="publicaciones_tab" role="tabpanel" aria-labelledby="simple-tab-0">
                        <div class="row">
                            @include('pages.search.tabs.publicaciones')
                        </div>
                    </div>
                    {{-- Tab Cursos --}}
                    <div class="tab-pane" id="cursos_tab" role="tabpanel" aria-labelledby="simple-tab-1">
                        <div class="row">
                            @include('pages.search.tabs.cursos')
                        </div>
                    </div>
                    {{-- Tab Avisos --}}
                    <div class="tab-pane" id="avisos_tab" role="tabpanel" aria-labelledby="simple-tab-3">
                        <div class="row">
                            @include('pages.search.tabs.avisos')
                        </div>
                    </div>
                    {{-- Tab Comentarios --}}
                    <div class="tab-pane" id="comentarios_tab" role="tabpanel" aria-labelledby="simple-tab-4">
                        <div class="row">
                            @include('pages.search.tabs.comentarios')
                        </div>
                    </div>
                    {{-- Tab Usuarios --}}
                    <div class="tab-pane" id="usuarios_tab" role="tabpanel" aria-labelledby="simple-tab-5">
                        <div class="row">
                            @include('pages.search.tabs.usuarios')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
