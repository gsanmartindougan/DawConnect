@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('perfil.index') }}
    <div class="card mx-0" style="background-color: rgba(254, 253, 237, 0.4);">
        <div class="card-body justify-content-md-center mx-0">
            <h2 class="card-title text-center">{{ auth()->user()->name }}</h2>
            <div class="container">
                <!-- Tabs navs -->
                <div class="d-flex justify-content-center">
                    <ul class="nav nav-underline">
                        <li class="nav-item">
                            <h5>
                                <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover active"
                                    aria-current="page" data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-0"
                                    aria-selected="true" href="#datos_personales">Datos personales</a>
                            </h5>
                        </li>
                        @if (auth()->user()->student)
                            <li class="nav-item">
                                <h5>
                                    <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                        data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-1"
                                        aria-selected="false" href="#mis_publicaciones">Mis publicaciones</a>
                                </h5>
                            </li>
                        @endif
                        @if (auth()->user()->teacher)
                            <h5>
                                <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                    data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-1"
                                    aria-selected="false" href="#mis_cursos">Mis cursos</a>
                            </h5>
                        @endif
                        @if (auth()->user()->mod)
                            <h5>
                                <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                    data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-1"
                                    aria-selected="false" href="#mis_avisos">Mis avisos</a>
                            </h5>
                        @endif
                        <li class="nav-item">
                            <h5>
                                <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                    data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-2"
                                    aria-selected="false" href="#mis_favoritos">Mis favoritos</a>
                            </h5>
                        </li>
                    </ul>
                </div>
                <!-- Tabs navs -->
            </div>
            <div class="card-body">
                {{-- Tabs --}}
                <div class="tab-content" role="tablist">
                    {{-- Tab datos personales --}}
                    <div class="tab-pane active " id="datos_personales" role="tabpanel" aria-labelledby="simple-tab-0">
                        <div class="row justify-content-center">
                            @include('pages.profile.tabs.datos')
                        </div>
                    </div>
                    @if (auth()->user()->student)
                        {{-- Tab mis publicaciones --}}
                        <div class="tab-pane" id="mis_publicaciones" role="tabpanel" aria-labelledby="simple-tab-1">
                            <div class="row p-0">
                                @include('pages.profile.tabs.publicaciones')
                            </div>
                        </div>
                    @endif
                    @if (auth()->user()->teacher)
                        {{-- Tab mis cursos --}}
                        <div class="tab-pane" id="mis_cursos" role="tabpanel" aria-labelledby="simple-tab-1">
                            <div class="row p-0">
                                @include('pages.profile.tabs.cursos')
                            </div>
                        </div>
                    @endif
                    @if (auth()->user()->mod)
                        {{-- Tab mis cursos --}}
                        <div class="tab-pane" id="mis_avisos" role="tabpanel" aria-labelledby="simple-tab-1">
                            <div class="row p-0">
                                @include('pages.profile.tabs.avisos')
                            </div>
                        </div>
                    @endif
                    {{-- Tab favoritos --}}
                    <div class="tab-pane" id="mis_favoritos" role="tabpanel" aria-labelledby="simple-tab-2">
                        <div class="row p-0">
                            @include('pages.profile.tabs.favoritos')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Cambio de contraseña --}}
    @include('pages.profile.modals.password')
    @include('pages.profile.modals.avatar')
@endsection
