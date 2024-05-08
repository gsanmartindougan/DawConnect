@extends('layouts.app')
{{--  dd(session('asignaturas')) --}}
@section('content')
    <div class="card mx-4" style="background-color: rgb(254, 253, 237, 0.4); ">
        <div class="container">
            <!-- Tabs navs -->
            <div class="d-flex justify-content-center">
                <ul class="nav nav-underline">
                    <li class="nav-item">
                        <h5>
                            <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover active"
                                aria-current="page" data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-0"
                                aria-selected="true" href="#publicaciones_recientes">Publicaciones
                                recientes</a>
                        </h5>
                    </li>
                    <li class="nav-item">
                        <h5>
                            <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-1" aria-selected="false"
                                href="#cursos_recientes">Cursos recientes</a>
                        </h5>
                    </li>
                    <li class="nav-item">
                        <h5>
                            <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-2" aria-selected="false"
                                href="#avisos">Avisos</a>
                        </h5>
                    </li>
                </ul>
            </div>
            <!-- Tabs navs -->
        </div>
        <div class="card-body mx-4">
            {{-- Tabs --}}
            <div class="tab-content" role="tablist">
                {{-- Tab publicaciones recientes --}}
                <div class="tab-pane active " id="publicaciones_recientes" role="tabpanel" aria-labelledby="simple-tab-0">
                    @include('pages.home.tabs.publicaciones')
                </div>

                {{-- Tab cursos recientes --}}
                <div class="tab-pane" id="cursos_recientes" role="tabpanel" aria-labelledby="simple-tab-1">
                    @include('pages.home.tabs.cursos')
                </div>

                {{-- Tab avisos --}}
                <div class="tab-pane" id="avisos" role="tabpanel" aria-labelledby="simple-tab-2">
                    <div class="container">
                        avisos
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script>
        let mensaje = localStorage.getItem('mensaje');

        if (mensaje) {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: mensaje,
            });
            localStorage.removeItem('mensaje');
        }
    </script>
@endpush
