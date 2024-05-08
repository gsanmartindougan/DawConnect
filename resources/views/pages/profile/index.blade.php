@extends('layouts.app')

@section('content')
    {{-- dd($tab) --}}
    <div class="card mx-4" style="background-color: rgba(254, 253, 237, 0.4);">
        <div class="card-body justify-content-md-center mx-4">
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
                        <li class="nav-item">
                            <h5>
                                <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                    data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-1"
                                    aria-selected="false" href="#mis_publicaciones">Mis publicaciones</a>
                            </h5>
                        </li>
                        <li class="nav-item">
                            <h5>
                                <a class="nav-link link-body-emphasis link-offset-2 link-underline-opacity-25 link-underline-opacity-75-hover"
                                    data-bs-toggle="tab" role="tab" aria-controls="simple-tabpanel-2"
                                    aria-selected="false" href="#tareas">Tareas</a>
                            </h5>
                        </li>
                    </ul>
                </div>
                <!-- Tabs navs -->
            </div>
            <div class="card-body mx-2">
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
                                                <img class="thumbnail" src="{{ auth()->user()->avatar }}" alt="Avatar">
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Nombre</label>
                                                <input type="text" class="form-control" id="name"
                                                    value="{{ auth()->user()->name }}" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email"
                                                    value="{{ auth()->user()->email }}" readonly>
                                            </div>
                                            <div class="mb-3 text-end">
                                                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cambioPass">
                                                    <span class="text-center mb-3">Cambio de contraseña</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Tab mis publicaciones --}}
                    <div class="tab-pane" id="mis_publicaciones" role="tabpanel" aria-labelledby="simple-tab-1">
                        <div class="d-felx row">
                            <div class="col-11 mb-2">
                                <input type="text" id="searchInput" class="form-control"
                                    placeholder="Buscar publicaciones...">
                            </div>
                            <div class="col-1 mb-2 text-end">
                                <button type="button" class="btn btn-sm btn-success"
                                    id="search_btn"><x-antdesign-search-o /></button>
                                <input type="hidden" name="user_id" id="user_id" value="{{auth()->user()->id}}">
                            </div>
                        </div>
                        <div id="paginacion-container">
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

    {{-- Cambio de contraseña --}}
    @include('pages.profile.modals.password')
@endsection
@push('custom-scripts')
    <script src=" {{ asset('js/paginacion.js') }} "></script>
    <script>
        $(document).ready(function() {
            $('#search_btn').on('click', function() {
                let user_id = $('#user_id').val();
                let query = $('#searchInput').val();
                $.ajax({
                    url: '/posts/search',
                    method: 'GET',
                    data: {
                        query: query,
                        user_id: user_id
                    },
                    success: function(data) {
                        $('#paginacion-container').html(data);
                    }
                });
            });
        });
    </script>
    <script>
        let mensaje = localStorage.getItem('mensaje');

        if (mensaje) {
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: mensaje,
            });
            localStorage.removeItem('mensaje_error');
            localStorage.removeItem('mensaje');
        }
        let mensaje_error = localStorage.getItem('mensaje_error');

        if (mensaje_error) {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: mensaje_error,
            });
            localStorage.removeItem('mensaje');
            localStorage.removeItem('mensaje_error');
        }

        document.getElementById('cambio').addEventListener('submit', function(event) {
            event.preventDefault();
            Swal.showLoading()
            let formData = ({
                antigua: document.getElementById('password').value,
                nueva1: document.getElementById('password_confirmation_1').value,
                nueva2: document.getElementById('password_confirmation_2').value,
            });
            axios.post('{{ route('cambioPassword') }}', formData)
                .then(function(response) {
                    let mensaje = response.data.mensaje;
                    let mensaje_error = response.data.mensaje_error;
                    if (mensaje) {
                        localStorage.setItem('mensaje', mensaje);
                    }
                    if (mensaje_error) {
                        localStorage.setItem('mensaje_error', mensaje_error);
                    }
                    window.location.reload();
                })
                .catch(function(error) {
                    console.error(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Algo ha salido mal. Por favor, inténtalo de nuevo más tarde.',
                    });
                });
        });
    </script>
@endpush
