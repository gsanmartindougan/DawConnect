@extends('layouts.app')

@section('content')
{{ Breadcrumbs::render('asignatura.show', $asignatura) }}
<div class="card" style="background-color: rgba(254, 253, 237, 0.4);">
    <div class="card-body justify-content-md-center mx-0">
        <h1 class="mb-4 text-center"> {{ $posts[0]?->asignatura?->name ?? $asignatura->name}} </h1>
        <div class="container">
            <!-- Tabs navs -->
            <div class="d-flex justify-content-center">
                <ul class="nav nav-underline">
                    <li class="nav-item">
                        <h5>
                            <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover active"
                                aria-current="page" data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-0"
                                aria-selected="true" href="#tab_publicaciones">Publicaciones</a>
                        </h5>
                    </li>
                    <li class="nav-item">
                        <h5>
                            <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-1"
                                aria-selected="false" href="#tab_cursos">Cursos</a>
                        </h5>
                    </li>
                </ul>
            </div>
            <!-- Tabs navs -->
        </div>
        <div class="card-body">
            {{-- Tabs --}}
            <div class="tab-content" role="tablist">
                {{-- Tab publicaciones --}}
                <div class="tab-pane active " id="tab_publicaciones" role="tabpanel" aria-labelledby="simple-tab-0">
                    <div class="row justify-content-center">
                        @include('pages.asignaturas.tabs.post')
                    </div>
                </div>

                {{-- Tab cursos --}}
                <div class="tab-pane" id="tab_cursos" role="tabpanel" aria-labelledby="simple-tab-1">
                    <div class="row p-0">
                        @include('pages.asignaturas.tabs.curso')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-scripts')
<script>
    $(document).ready(function() {
        $('#publicaciones_table').DataTable();
    });
    $(document).ready(function() {
        $('#cursos_table').DataTable();
    });
</script>
@endpush
