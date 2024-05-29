@extends('layouts.app')

@section('content')
    {{-- dd($user) --}}
    <div class="card mx-0" style="background-color: rgba(254, 253, 237, 0.4);">
        <div class="card-body justify-content-md-center mx-0">
            <h2 class="card-title text-center">{{ $user->name }}</h2>
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
                        <li class="nav-item">
                            <h5>
                                <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                    data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-1"
                                    aria-selected="false" href="#mis_publicaciones">Mis publicaciones</a>
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
                            <div class="card">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap">
                                        <div class="col-md-5">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <img class="thumbnail" src="{{ asset($user->avatar()) }}" alt="Avatar"
                                                    style="width: 200px; height: 200px;">
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="name"
                                                    value="{{ $user->name }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="fechaUnion" class="form-label">Se unión en:</label>
                                                <input type="text" class="form-control" id="fechaUnion"
                                                    value="{{ (new DateTime($user->created_at))->format('d-m-Y') }}"
                                                    readonly>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tab mis publicaciones --}}
                    <div class="tab-pane" id="mis_publicaciones" role="tabpanel" aria-labelledby="simple-tab-1">
                        <div class="row p-0">
                            @include('pages.profile.tabs.publicaciones')
                        </div>
                    </div>
                    {{-- Tab tareas --}}
                    <div class="tab-pane" id="tareas" role="tabpanel" aria-labelledby="simple-tab-2">
                        <div class="container">
                            avisos
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
